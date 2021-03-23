<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use Illuminate\Support\Arr;
use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory($parent_id, $id){
        $categoriesProducts = Categories::with('products')->where([['parent_id', '=', $parent_id], ['id', '=', $id]])->get();
        $products_ids = CategoryProducts::whereIn('category_id', Arr::pluck($categoriesProducts, 'id'))
            ->orderBy('product_id', 'desc')
            ->get()->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $products_ids)->paginate('10');
        $this_category = Categories::with('products')->where('id', '=', $id)->first();

        return response()->json([
            'products' => $products,
            'this_category' => $this_category
        ]);
    }

    public function getParentCategory($id, Request $request){
        $categoryParentProducts = Categories::select('id')->where('parent_id', '=', $id)->get()->toArray();
        $products_ids = CategoryProducts::whereIn('category_id', Arr::pluck($categoryParentProducts, 'id'))
            ->orderBy('product_id', 'desc')
            ->get()->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $products_ids)->paginate('10');
        $this_category = Categories::with('products')->where('id', '=', $id)->first();
        return view('allcategory', compact('products', 'this_category'));
    }
}
