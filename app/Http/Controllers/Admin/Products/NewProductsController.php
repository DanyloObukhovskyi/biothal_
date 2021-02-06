<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Requests\Products\{
    Add as ProductAddRequest,
    Change as ProductChangeRequest,
    GetForChange as IdValidationRequest,
};

use App\Models\{
    Image,
    Categories,
    AccessoryProducts,
    CategoryProducts,
    Admin\Products\Sale,
    Admin\Products\Product,
    Admin\Accessories\Accessories
};

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NewProductsController extends Controller
{
    public function indexNew(Request $request){
//        dd($request->all());

        if(!empty($request->all())) {
            $products = Product::select();
            if(!empty(json_decode($request->input('title_product')))) {
                $products = $products->where('');
            }
        }
        if(!empty(json_decode($request->input('title_product'))))
        $products = Product::all()->toArray();
//        dd($products);
        return view('admin.products.indexNew', compact('products'));
    }

    public function changeProd($id){
        return view('admin.products.changeNewProd');
    }

    public function information(){
        return view('admin.products.information');
    }
    public function changeInformation(){
        return view('admin.products.changeInformation');
    }
}
