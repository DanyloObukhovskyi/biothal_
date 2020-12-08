<?php

namespace App\Http\Controllers;
use App\Models\Admin\Products\Product;
use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;

class FaceController extends Controller
{
    public function getAllCategory()
    {
        $face = Product::All();
        return view('face', compact('face'));
    }

//    public function getAllProduct()
//    {
//        $face = Categories::with('products')->where('id', '=', 50)->get();
////        dd($face->toArray());
//        return view('face', compact('face'));
//    }
}
