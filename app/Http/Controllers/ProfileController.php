<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\User\changePass as changePasswordRequest;
use App\Http\Requests\User\Update as updateProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\{Categories,
    CategoryProducts,
    EmailForEmailNewsletter,
    GroupSale,
    Image,
    StockStatus,
    Admin\Products\Product};
use Illuminate\Support\Facades\Log;
use App\Http\Requests\
{
    ValidImgRequest,
    Images\Delete as ImageDeleteRequest
};
use Illuminate\Support\Facades\Storage;
use App\Models\UserGroup;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getProfile()
    {
        $userId = auth()->user()->id;
        $user = User::with([
            'emailReceive',
            'image'
        ])->find($userId);

        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function changePassword(changePasswordRequest $request)
    {
        $valid_pass = Hash::check($request->old_password, auth()->user()->password);

        if(!$valid_pass){
            return response()->json([
                'errors' => [
                    'old_password' => ['Вы ввели не верный старый пароль']
                    ],
            ], 422);
        }
        $userId = auth()->user()->id;

        $user = User::find($userId);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Пароль успешно изменен',
        ], 200);
    }

    public function updateProfile(updateProfileRequest $request)
    {
        $userId = auth()->user()->id;

        $user = User::find($userId);

        $user->name = $request->name;
        $user->sur_name = $request->sur_name;
        $user->date_of_birth = $request->date_of_birth;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        $user = User::find($userId);
        if(isset($request->is_receive)){
            $emailExist = EmailForEmailNewsletter::where('email', $user->email)->first();
            if(!empty($emailExist)){
                $emailExist->is_receive = $request->is_receive;
                $emailExist->save();
            } else {
                EmailForEmailNewsletter::create([
                    'email' => $user->email,
                    'is_receive' => $request->is_receive
                ]);
            }
        }
        return response()->json([
            'message' => 'Данные успешно изменены',
        ], 200);
    }

    public function addImage(ValidImgRequest $request)
    {
        if (!$request->hasFile('img')) {
            return response()->json([
                'message' => 'Изображение не загрузилось',
            ], 413);
        } else {
            $userId = auth()->user()->id;
            $img = $request->file('img');
            $name = $img->getClientOriginalName();

            // Помещаем файл в репозиторий
            $img->move(public_path("storage/img/users"), $name);
            // Добавляем файл в базу
            $image = Image::create([
                'name' => $name
            ]);

            $user = User::with([
                'emailReceive',
                'image'
            ])->find($userId);
            $user->image_id = $image->id;
            $user->save();

            $user = User::with([
                'emailReceive',
                'image'
            ])->find($userId);

            return response()->json([
                'message' => 'Изображение сохранилось',
                'profile' => $user
            ], 200);
        }
    }

    public function deleteImage(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::with([
            'emailReceive',
            'image'
        ])->find($userId);

        $image = Image::where('id', $user->image_id)->first();
        $pathToYourFile = public_path("storage/img/users/".$image->name);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }
        $image->delete();
        $user->image_id = null;
        $user->save();
        $user = User::with([
            'emailReceive',
            'image'
        ])->find($userId);

        return response()->json([
            'message' => 'Вы успешно удалили изображение',
            'profile' => $user
        ], 200);
    }

    public function getGroupSales()
    {
        $user = auth()->user();
        $group = [];
        $count = 1;
        $totalSum = 0;
        $percent = 0;
        if(!empty($user)){
            $mainUser = User::with('totalOrders')->find($user->id)->toArray();
            $sum = 0;
            if(!empty($mainUser['total_orders'])){
                foreach($mainUser['total_orders'] as $order){
                    $sum += $order['total_sum'];
                    $totalSum += $order['total_sum'];
                }
            }
            $group[] = [
                'id' => $count,
                'name' => !empty($mainUser['sur_name']) ? $mainUser['name'] .' '. $mainUser['sur_name'] : $mainUser['name'],
                'sum' => $sum
            ];
            $count++;
            $subUsers = UserGroup::where('user_id', $user->id)->with('attachedUser')->get()->toArray();
            if(!empty($subUsers)){
                foreach($subUsers as $subUser){
                    $sum = 0;
                    if(!empty($subUser['attached_user']['total_orders'])){
                        foreach($subUser['attached_user']['total_orders'] as $order){
                            $sum += $order['total_sum'];
                            $totalSum += $order['total_sum'];
                        }
                    }
                    $group[] = [
                        'id' => $count,
                        'name' => !empty($subUser['attached_user']['sur_name']) ? $subUser['attached_user']['name'] .' '. $subUser['attached_user']['sur_name'] : $subUser['attached_user']['name'],
                        'sum' => $sum
                    ];
                    $count++;
                }
            }
            $mainUsers  = UserGroup::where('attached_user_id', $user->id)->with('mainUser')->get()->toArray();
            if(!empty($mainUsers)){
                foreach($mainUsers as $mainUser){
                    $sum = 0;
                    if(!empty($mainUser['main_user']['total_orders'])){
                        foreach($mainUser['main_user']['total_orders'] as $order){
                            $sum += $order['total_sum'];
                            $totalSum += $order['total_sum'];
                        }
                    }
                    $group[] = [
                        'id' => $count,
                        'name' => !empty($mainUser['main_user']['sur_name']) ? $mainUser['main_user']['name'] .' '. $mainUser['main_user']['sur_name'] : $mainUser['main_user']['name'],
                        'sum' => $sum
                    ];
                    $count++;
                }
            }
            $groupPercent = GroupSale::where('sum', '<=', $totalSum)->orderBy('sum', 'DESC')->first();
            $percent = $groupPercent->percent ?? 0;

            return response()->json([
                'group' => $group,
                'total_sum' => $totalSum,
                'percent' => $percent
            ], 200);
        }
    }
}
