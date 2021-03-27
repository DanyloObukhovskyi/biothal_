<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Login as LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();

        if(!empty($user)){
            if(!$token = auth()->attempt([
                'email' => $user->email,
                'password' => $request->password
            ])){
                return response()->json([
                    'message' => 'Проверьте ваши учетные данные',
                ], 413);
            }

        } else {
            return response()->json([
                'message' => 'Проверьте ваши учетные данные',
            ], 413);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function checkUser()
    {
        $user = auth()->user();
        $exist = false;
        if(!empty($user)){
            $exist = true;
        }

        return response()->json([
            'exist' => $exist
        ]);
    }
}
