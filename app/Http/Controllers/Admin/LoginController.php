<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()){
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->except(['_token']);
        Auth::attempt($credentials, true);

        if (Auth::user()->isAdmin()){
            return redirect()->route('admin.dashboard');
        } else {
            Auth::logout();
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
