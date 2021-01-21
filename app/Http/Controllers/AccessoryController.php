<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessoryProducts;
use App\Models\Admin\Accessories\Accessories;
use App\Models\Admin\Products\Product;

class AccessoryController extends Controller
{
    public function getAccessory($parent_id, $id){
        $accessoriesProducts = Accessories::with('products')->where([['parent_id', '=', $parent_id], ['id', '=', $id]])->get();
        $accessoryParentProducts = Accessories::with('products')->where('id', '=', $id)->get();
        $products_count_accessories = Accessories::with('products')->where('id', '=', $id)->count();
        return view('accessory', compact('accessoriesProducts', 'products_count_accessories', 'accessoryParentProducts'));
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
