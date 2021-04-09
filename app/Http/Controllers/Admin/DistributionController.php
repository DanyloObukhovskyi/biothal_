<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Distribution\{
    Create as CreateEmailDistributionRequest,
    Update as UpdateEmailDistributionRequest
};
use App\Http\Controllers\Controller;
use App\Models\EmailGroup;
use Illuminate\Http\Request;
use App\Models\EmailForEmailNewsletter;
use App\Models\PhoneReceive;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\DefaultMail;

class DistributionController extends Controller
{
    public function email(Request $request)
    {
        $emails = EmailForEmailNewsletter::where('is_receive', false)->with('group')->get();
        $groups = EmailGroup::all();
        if (empty($emails)) {
            return view('admin.distribution.email', [
                'emails',
                'groups'
            ]);
        }

        if ($request->ajax()) {
            foreach ($emails as $key => $value){
                $emails[$key]['number'] = $key+1;
            }
            return Datatables::of($emails)
                ->editColumn('email', function ($row) {
                    return $row->email;
                })
                ->editColumn('group', function ($row) {
                    return !empty($row->group_id) ? $row->group->name :  'Без Группы';
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-toggle="modal" data-target="#change_emails" id="' . ("emails_change" . $row->id) .'" data-id="' . $row->id . '" data-email="' . $row->email . '" data-group_id="' . $row->group_id . '" name="change" class="btn btn-outline-dark fa fa-wrench"></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $emails = EmailForEmailNewsletter::all();

        return view('admin.distribution.email', [
            'emails' => $emails,
            'groups' => $groups
        ]);
    }

    public function addEmail(CreateEmailDistributionRequest $request)
    {
        EmailForEmailNewsletter::create([
            'email' => $request->email,
            'group_id' => $request->group_id === '0' ? null : $request->group_id,
            'is_receive' => false
        ]);

        return response()->json([
            'message' => 'Эмейл успешно создан'
        ], 200);
    }

    public function editEmail(UpdateEmailDistributionRequest $request)
    {
        $email = EmailForEmailNewsletter::find($request->id);
        if(empty($email)){
            return response()->json([
                'message' => 'Эмейл не найден'
            ], 404);
        }
        $email->email = $request->email;
        $email->group_id = $request->group_id === '0' ? null : $request->group_id;
        $email->save();

        return response()->json([
            'message' => 'Эмейл успешно обновлен'
        ], 200);
    }

    public function deleteEmail(Request $request)
    {
        $status = $request->status;

        if ($status == 0) {
            if ($request->checked != 0) {

                foreach ($request->checked as $catId) {
                    $email = EmailForEmailNewsletter::where('id', (int)$catId)->delete();
                }
                return response()->json([
                    'accepted' => 'Эмейлы успешно удалены'
                ]);
            }

            return response()->json([
                'error' => "Выберите хотя бы 1 эмейл"
            ]);
        }

        if ($status == 1) {
            if ($request->checked != 0) {
                $values = [];
                foreach ($request->checked as $catId) {
                    $email = EmailForEmailNewsletter::where('id', (int)$catId)->first();

                    if ($email != null) {

                        $email->delete();
                    }
                }

                if (count(EmailForEmailNewsletter::all()) == 0){
                    return response()->json([
                        'status' => false,
                    ]);
                }

                return response()->json([
                    'accepted' => 'Эмейлы успешно удалены',
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'error' => "Выберите хотя бы 1 эмейл"
                ]);
            }
        }
    }

    public function addEmailGroup(Request $request)
    {

    }

    public function editEmailGroup(Request $request)
    {

    }

    public function deleteEmailGroup(Request $request)
    {

    }

    public function sendEmails(Request $request)
    {
        $groupId = $request->group_id === '0' ? null : $request->group_id;
        $emails = EmailForEmailNewsletter::where('group_id', $groupId)->get();

        $count = 0;
        if(!empty($emails)){
            foreach($emails as $email){
                if(!empty($request->description)){
                    $count += 1;
                    Mail::to($email->email)->send(new DefaultMail($request->description));
                } else {
                    return response()->json([
                        'message' => 'Вы не можете отправить письмо с пустым текстом',
                    ], 404);
                }
            }
        } else {
            return response()->json([
                'message' => 'Не найдено ни одного эмейла в группе',
            ], 404);
        }
        if($count === 0){
            return response()->json([
                'message' =>  'Писем не отправлено',
            ], 200);
        }
        return response()->json([
            'message' =>  $count > 1 ? "Вы успешно отправили ".$count." писем" : "Вы успешно отправили ".$count." письмо" .'',
        ], 200);
    }

    public function phone(Request $request)
    {
        $phones = PhoneReceive::where('is_receive', true)->with('group')->get();
        if (empty($phones)) {
            return view('admin.distribution.phone', [
                'phones'
            ]);
        }

        if ($request->ajax()) {
            foreach ($phones as $key => $value){
                $phones[$key]['number'] = $key+1;
            }
            return Datatables::of($phones)
                ->editColumn('phone', function ($row) {
                    return $row->phone;
                })
                ->editColumn('group', function ($row) {
                    return !empty($row->group_id) ? $row->group->name :  'Без Группы';
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-toggle="modal" id="' . ("phones_change" . $row->id) .'" data-id="' . $row->id . '" name="change" class="btn btn-outline-dark fa fa-wrench"></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $phones = PhoneReceive::all();
        $groups = EmailGroup::all();

        return view('admin.distribution.phone', [
            'phones' => $phones,
            'groups' => $groups
        ]);
    }

    public function addPhone(Request $request)
    {

    }

    public function editPhone(Request $request)
    {

    }

    public function deletePhone(Request $request)
    {

    }

    public function addPhoneGroup(Request $request)
    {

    }

    public function editPhoneGroup(Request $request)
    {

    }

    public function deletePhoneGroup(Request $request)
    {

    }

    public function sendSms(Request $request)
    {

    }
}
