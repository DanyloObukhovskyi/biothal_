<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($id){
        $products = Product::with('getImage')->get();
        return view('product', compact('id', 'products'));
    }
}
