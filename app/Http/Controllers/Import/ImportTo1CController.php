<?php

namespace App\Http\Controllers\Import;

use App\Traits\OrdersTrait;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

use App\Models\{
    Order
};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Session;

class ImportTo1CController {

    use OrdersTrait;

    /**
     * App\Models\ShoppingCart
     * */
    protected $order;

    protected $stepCheckAuth = 'checkauth';
    protected $stepInit = 'init';

    protected $stepFile = 'file';
    protected $stepImport = 'import';
    protected $stepDeactivate = 'deactivate';
    protected $stepComplete = 'complete';

    protected $stepQuery = 'query';
    protected $stepSuccess = 'success';
    protected $request;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    /**
     * Method for generate xml for import data to 1C.
     *
     * @param Request $request
     * @return xml
     */
    public function getDataToImportTest () {

        $orders = $this->getNotImportedOrderData([
            'products',
            'userAddress',
            'orderType',
            'payment'
        ]);
        $data = $this->prepareXmlArray($orders);
        $result = ArrayToXml::convert($data);

        return response($result, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    /**
     * @return xml
     */
    public function getTestDataToImport () {
        return response("<test>qdqwd</test>", 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    /**
     * @return xml
     */
    public function getHardDataToImport () {
        return response("<test>qdqwd</test>", 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    public function getDataToImport(Request $request)
    {
        $type = $request->get('type');
        $mode = $request->get('mode');

        $this->request = $request;
        if (!$type) {
            $type = 'sale';
        }

        $this->logRequestData($type, $mode);

        if ($type != 'catalog' && $type != 'sale') {
            return $this->checkAuth('');
        }

        if (!$this->checkCSRF($mode)) {
            return $this->failure('CSRF token mismatch');
        }

        if (!$this->userLogin()) {
            return $this->failure('Не правильные данные для авторизации');
        } else {
            // как выяснилось - после авторизации Laravel меняет id сессии, т.о.
            // при каждом запросе от 1С будет новая сессия и если что-то туда
            // записать то это будет потеряно, поэтому берем ИД сессии, который
            // был отправлен в 1С на этапе авторизации и принудительно устанавливаем
            $cookie = $this->request->header('cookie');
            $sessionName = config('session.cookie');
            if ($cookie
                && preg_match("/$sessionName=([^;\s]+)/", $cookie, $matches)) {
                // если убрать эту строчку и сделать вот так
                // session()->setId($matches[1]), то ИНОГДА o_O это приводит к
                // ошибке - говорит, что ничего не передано, хотя оно есть и
                // передается
                $id = $matches[1];
                session()->setId($id);
            }
        }

        switch ($mode) {
            case $this->stepCheckAuth:
                return $this->checkAuth($type);
                break;

            case $this->stepInit:
                return $this->init($type);
                break;

            case $this->stepFile:
                return $this->getFile();
                break;

            case $this->stepImport:
                try {
                    return true;
                } catch (Exception $e) {
                    return $this->failure($e->getMessage());
                }
                break;

            case $this->stepDeactivate:
                $startTime = $this->getStartTime();

                return $startTime !== null ??
                    $this->failure('Cannot get start time of session, url: '.$this->request->fullUrl()."\nRegexp: (\d{4}-\d\d-\d\d)_(\d\d:\d\d:\d\d)");
                break;

            case $this->stepComplete:
                return true;
                break;

            case $this->stepQuery:
                return $this->processQuery();
                break;

            case $this->stepSuccess:
                if($type === 'sale') {
                    return $this->saleSuccess();
                }

                return '';
        }

        return $this->failure();
    }

    protected function checkAuth($type)
    {
        $cookieName = config('session.cookie');
        $cookieID = Session::getId();

        $answer = "success\n$cookieName\n$cookieID";

        if ($type === 'catalog') {
            $answer .= "\n".csrf_token()."\n".date('Y-m-d_H:i:s');
        } elseif ($type === 'sale') {
            $answer .= "\n".csrf_token();
        }

        return $this->answer($answer);
    }

    protected function answer($answer)
    {
        return iconv('UTF-8', 'windows-1251', $answer);
    }

    protected function checkCSRF($mode)
    {
        if ($mode === $this->stepCheckAuth) {
            return true;
        }

        foreach ($this->request->all() as $key => $item) {
            if ($key === Session::token()) {
                return true;
            }
        }

        return true;
    }

    protected function logRequestData($type, $mode)
    {
        Log::debug('Command from 1C type: '.$type.'; mode: '.$mode);
    }

    protected function userLogin()
    {
        if (Auth::getUser() === null) {
            $user = \Request::getUser();
            $pass = \Request::getPassword();

            $attempt = Auth::attempt(['email' => $user, 'password' => $pass]);

            if (! $attempt) {
                return false;
            }

            $gates = [];
            if (! is_array($gates)) {
                $gates = [$gates];
            }

            foreach ($gates as $gate) {
                if (Gate::has($gate) && Gate::denies($gate, Auth::user())) {
                    Auth::logout();

                    return false;
                }
            }

            return true;
        }

        return true;
    }

    protected function failure($details = '')
    {
        $return = "failure".(empty($details) ? '' : "\n$details");

        return $this->answer($return);
    }

    protected function init($type)
    {
        $zip = "zip=".($this->canUseZip() ? 'yes' : 'no');
        $limit = 1 * 1000 * 1024;
        $answer = "$zip\n$limit";

        if ($type === 'catalog' || $type === 'sale') {
            $answer .=
                "\n".Session::getId().
                "\n".'2.08';
        }

        return $this->answer($answer);
    }

    protected function canUseZip()
    {
        return class_exists('ZipArchive');
    }

    protected function getStartTime()
    {
        foreach (array_keys($this->request->all()) as $item) {
            if(preg_match("/(\d{4}-\d\d-\d\d)_(\d\d:\d\d:\d\d)/", $item, $matches)) {
                return "$matches[1] $matches[2]";
            }
        }

        return null;
    }

    protected function processQuery()
    {
        try {
            return $this->getDataToImportTest();
//            $model = $this->saleGetModel();

//            try {
//                if ($model instanceof ExportOrders) {
//                    return $this->getOrdersDataInCommenceMlClient($model);
//                } elseif ($model instanceof ExportOrdersSelf) {
//                    return $this->getOrdersDataSelf($model);
//                }
//
//                return $model;
        } catch (Exception $e) {
            return $this->failure($e->getMessage());
        }
    }

    protected function saleSuccess()
    {
        return 'success';
    }
}
