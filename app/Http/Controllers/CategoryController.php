<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use App\Models\ImageGlobal;
use Illuminate\Support\Arr;
use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function getSubCategory($id, $children_id){
        $category = Categories::where('slug', $children_id)->first();
        $products_ids = CategoryProducts::select('product_id')->where([
            'category_id' => $category['id']
        ])->get();
        $products = Product::with([
                'image',
                'productDescription',
                'getSale'
            ])
            ->where([
                'status' => 1
            ])
            ->whereIn('id', $products_ids)
            ->paginate('100');
        $this_category = Categories::with('products')->where('id', '=', $category['id'])->first();

        $carousel = ImageGlobal::all();

        return response()->json([
            'carousel' => $carousel,
            'products' => $products,
            'this_category' => $this_category
        ]);
    }

    public function getCategory($id){
        $category = Categories::where('slug', $id)->first();
        $categoryParentProducts = Categories::select('id')->where('parent_id', '=', $category['id'])->get()->toArray();
        $products_ids = CategoryProducts::whereIn('category_id', Arr::pluck($categoryParentProducts, 'id'))
            ->orderBy('product_id', 'desc')
            ->get()->pluck('product_id')->toArray();
        $products = Product::with([
            'image',
            'productDescription',
            'getSale'
        ])
            ->where([
                'status' => 1
            ])
            ->whereIn('id', $products_ids)
            ->paginate('100');
        $this_category = Categories::with('products')->where('id', '=', $category['id'])->first();

        $carousel = ImageGlobal::all();

        return response()->json([
            'carousel' => $carousel,
            'products' => $products,
            'this_category' => $this_category
        ]);
    }
}
