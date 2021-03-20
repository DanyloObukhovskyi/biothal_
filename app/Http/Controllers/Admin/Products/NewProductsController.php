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
    StockStatus,
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
        $products = Product::with('productDescription');
        if(!empty($request->all())) {
            if($request->input('status') !== null) {
                $products = $products->where('status', $request->input('status'));
            }
            if(!empty($request->input('title_product'))) {
                $title = $request->input('title_product');
                $products = $products->whereHas('productDescription', function ($query) use ($title) {
                    $query->where('name', 'like', '%'.$title.'%');
                });
            }
        }
        $products = $products->get()->toArray();
        return view('admin.products.indexNew', compact('products'));
    }

    public function changeProd($id){
        $product = Product::where('id', $id)
            ->with(['productDescription', 'productTo1C', 'productCategory'])
            ->first();
        if (empty($product)) {
            abort(404);
        }
//        dd($product);
        $stock_statuses = StockStatus::all()->toArray();
        $categories = Categories::whereNotNull('parent_id')->get()->toArray();
        foreach ($categories as $category_key => $category) {
            $main_cat_name = Categories::where('id', $category['parent_id'])->value('title');
            $full_cat_path = $main_cat_name . " > " . $category['title'];
            $categories[$category_key]["full_name"] = $full_cat_path;
        }

        return view('admin.products.changeNewProd', compact(
            'id',
            'product',
            'stock_statuses',
            'categories'
        ));
    }

    public function information(){
        return view('admin.products.information');
    }
    public function changeInformation(){
        return view('admin.products.changeInformation');
    }
}
