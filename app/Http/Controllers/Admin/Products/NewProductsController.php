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
    public function indexNew(){
        $products = Product::with('productDescription')->get()->toArray();
//        dd($products);
        return view('admin.products.indexNew', compact('products'));
    }

    public function changeProd($id){
        $product = Product::where('id', $id)->with('productDescription')->first();
        if (empty($product)) {
            abort(404);
        }

        return view('admin.products.changeNewProd', compact('id', 'product'));
    }

    public function information(){
        return view('admin.products.information');
    }
    public function changeInformation(){
        return view('admin.products.changeInformation');
    }
}
