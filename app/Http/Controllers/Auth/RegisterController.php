<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use http\Env;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\Create as createUser;
use App\Models\EmailForEmailNewsletter;
use App\Models\PhoneVerify;
use App\Models\PhoneReceive;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date' => ['date'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(createUser $request)
    {
        $user = User::create([
            'name' => $request->name,
            'sur_name' => $request->surname,
            'date_of_birth' => $request->date,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        $phone = $user->phone_number;
        $code = $this->generateRandomString(6);
        EmailForEmailNewsletter::create([
            'email' => $user->email,
            'is_receive' => $request->is_receive
        ]);

        PhoneReceive::create([
            'phone' => $user->phone_number,
            'is_receive' => $request->is_receive
        ]);


        PhoneVerify::create([
            'code' => $code,
            'phone_number' => $phone,
            'expired_in' => Carbon::now()->addMinute(30)
        ]);

        $this->sendCode($phone, $code);

        return response()->json([
            'message' => 'Вы успешно зарегистрировались',
        ], 201);
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sendCode($phone, $code)
    {

        $response = Http::get('https://api.turbosms.ua/message/send.json', [
            'recipients' => [
                $phone
            ],
            'sms' => [
                'sender' => 'Biothal',
                'text' => 'Ваш код подтверждения: '. $code,
            ],
            'token' => Env('TurboSmsToken')
        ]);
    }
}
