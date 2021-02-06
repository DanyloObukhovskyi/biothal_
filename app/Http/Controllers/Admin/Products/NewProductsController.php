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
        return view('admin.products.indexNew');
    }

    public function changeProd(){
        return view('admin.products.changeNewProd');
    }

    public function information(){
        return view('admin.products.information');
    }
    public function changeInformation(){
        return view('admin.products.changeInformation');
    }
}
