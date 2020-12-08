<?php

namespace App\Http\Controllers;
use App\Models\Admin\Accessories\Accessories;
use App\Models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $categories = Categories::all();
//        $accessories = Accessories::all();
        return view('home');
    }
}
