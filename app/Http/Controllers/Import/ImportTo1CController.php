<?php

namespace App\Http\Controllers\Import;

use App\Traits\OrdersTrait;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

use App\Models\{
    Order
};


class ImportTo1CController {

    use OrdersTrait;

    /**
     * App\Models\ShoppingCart
     * */
    protected $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    /**
     * Method for generate xml for import data to 1C.
     *
     * @param Request $request
     * @return xml
     */
    public function getDataToImport (Request $request) {
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
}
