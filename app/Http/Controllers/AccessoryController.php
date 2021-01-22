<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;
use App\Models\AccessoryProducts;
use App\Models\Admin\Accessories\Accessories;
use App\Models\Admin\Products\Product;
use Illuminate\Support\Arr;

class AccessoryController extends Controller
{
    public function getAccessory($parent_id, $id){
        $accessoriesProducts = Accessories::with('products')->where([['parent_id', '=', $parent_id], ['id', '=', $id]])->get();
        $products_ids = AccessoryProducts::whereIn('accessory_id', Arr::pluck($accessoriesProducts, 'id'))
            ->orderBy('product_id', 'desc')
            ->get()->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $products_ids)->paginate('1');
        $this_accessory = Accessories::with('products')->where('id', '=', $id)->first();
        return view('accessory', compact('products', 'this_accessory'));
    }

    public function getParentAccessory($id, Request $request){
        $accessoryParentProducts = Accessories::select('id')->where('parent_id', '=', $id)
            ->get()->pluck('id')->toArray();
        $products_ids = AccessoryProducts::whereIn('accessory_id', $accessoryParentProducts)
            ->orderBy('product_id', 'desc')->get()->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $products_ids)->paginate('10');
        $this_accessory = Accessories::with('products')->where('id', '=', $id)->first();
        return view('allaccessory', compact('products', 'this_accessory'));
    }
}
