<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory($parent_id, $id){
        $categoriesProducts = Categories::with('products')->where([['parent_id', '=', $parent_id], ['id', '=', $id]])->get();
        $categoryParentProducts = Categories::with('products')->where('id', '=', $id)->get();
        $products_count = Categories::with('products')->where('id', '=', $id)->count();
        return view('category', compact('categoriesProducts', 'products_count', 'categoryParentProducts'));
    }

    public function getParentCategory($id){
        $categoryParentProducts = Categories::with('products')->where('parent_id', '=', $id)->get();
        $this_category = Categories::with('products')->where('id', '=', $id)->first();
        return view('allcategory', compact('categoryParentProducts', 'this_category'));
    }
}
