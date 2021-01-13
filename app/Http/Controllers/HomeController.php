<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('sale_id', '!=', null)->limit(9)->get();
        $products2 = Product::where('sale_id', '=', null)->paginate(9);

        return view('home', compact('products', 'products2'));

    }
    public function about()
    {
        return view('about');
    }
}
