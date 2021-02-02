<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\Add as ProductAddRequest;
use App\Http\Requests\Products\GetForChange as IdValidationRequest;
use App\Http\Requests\Products\Change as ProductChangeRequest;
use App\Models\AccessoryProducts;
use App\Models\Admin\Accessories\Accessories;
use App\Models\Admin\Products\Product;
use App\Models\Admin\Products\Sale;
use App\Models\Categories;
use App\Models\CategoryProducts;
use App\Models\Image;
use Illuminate\Http\Request;
use DataTables;

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
