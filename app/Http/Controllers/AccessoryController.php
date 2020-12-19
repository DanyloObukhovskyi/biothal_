<?php

namespace App\Http\Controllers;

use App\Models\Admin\Accessories\Accessories;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function getAccessory($parent_id, $id){
        $accessoriesProducts = Accessories::with('products')->where([['parent_id', '=', $parent_id], ['id', '=', $id]])->get();
        $accessoryParentProducts = Accessories::with('products')->where('id', '=', $id)->get();
        $products_count_accessories = Accessories::with('products')->where('id', '=', $id)->count();
        return view('accessory', compact('accessoriesProducts', 'products_count_accessories', 'accessoryParentProducts'));
    }

    public function getParentAccessory($id){
        $accessoryParentProducts = Accessories::with('products')->where('parent_id', '=', $id)->get();
        $this_accessory = Accessories::with('products')->where('id', '=', $id)->first();
        return view('allaccessory', compact('accessoryParentProducts', 'this_accessory'));
    }
}
