<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortmoneController extends Controller
{
    public function index()
    {
        return view('portmone');
    }
    public function success()
    {
        return view('success');
    }
}
