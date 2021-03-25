<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use Illuminate\Support\Arr;
use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function getSubCategory($id, $children_id){
        $category = Categories::where('slug', $children_id)->first();
        $products_ids = CategoryProducts::where('category_id', $category['id'])->get();
        $products = Product::with('image', 'productDescription')->whereIn('id', $products_ids)->paginate('100');
        $this_category = Categories::with('products')->where('id', '=', $category['id'])->first();

//        $products = Product::with('image', 'productDescription')->whereIn('id', $products_ids)->paginate('10');
//        $categoriesProducts = Categories::with('products')->where([['parent_id', '=', $parent_id], ['id', '=', $id]])->get();
//        $products_ids = CategoryProducts::whereIn('category_id', Arr::pluck($categoriesProducts, 'id'))
//            ->orderBy('product_id', 'desc')
//            ->get()->pluck('product_id')->toArray();
//        $products = Product::whereIn('id', $products_ids)->paginate('10');
//        $this_category = Categories::with('products')->where('id', '=', $id)->first();
//
        return response()->json([
            'products' => $products,
            'this_category' => $this_category
        ]);
    }

    public function getCategory($id, Request $request){
        $category = Categories::where('slug', $id)->first();
        $categoryParentProducts = Categories::select('id')->where('parent_id', '=', $category['id'])->get()->toArray();
        $products_ids = CategoryProducts::whereIn('category_id', Arr::pluck($categoryParentProducts, 'id'))
            ->orderBy('product_id', 'desc')
            ->get()->pluck('product_id')->toArray();
        $products = Product::with('image', 'productDescription')->whereIn('id', $products_ids)->paginate('100');
        $this_category = Categories::with('products')->where('id', '=', $category['id'])->first();
Log::info($products);
        return response()->json([
            'products' => $products,
            'this_category' => $this_category
        ]);
    }
}
