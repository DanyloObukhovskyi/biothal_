<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory($id){
        $categoriesProducts = Categories::with('products')->where('id', '=', $id)->get();
        $products_count = Categories::with('products')->where('id', '=', $id)->count();
        return view('category', compact('categoriesProducts', 'products_count'));
    }
}
