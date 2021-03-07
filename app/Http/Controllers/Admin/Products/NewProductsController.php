<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Requests\Products\{
    Create as ProductCreate,
    Update as ProductUpdate
};

use App\Models\Admin\Products\{
    ProductApts,
    ProductTo1C,
    ProductImages,
    ProductsAttributes,
    ProductDescription
};

use App\Models\{
    Categories,
    StockStatus,
    Admin\Products\Product
};

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

    public function createProd(){

        $stock_statuses = StockStatus::all()->toArray();
        $categories = Categories::whereNotNull('parent_id')->get()->toArray();
        foreach ($categories as $category_key => $category) {
            $main_cat_name = Categories::where('id', $category['parent_id'])->value('title');
            $full_cat_path = $main_cat_name . " > " . $category['title'];
            $categories[$category_key]["full_name"] = $full_cat_path;
        }

        return view('admin.products.changeNewProd', compact(
            'stock_statuses',
            'categories'
        ));
    }

    public function createProdProcess(ProductCreate $request){

        /* START: updating data for product*/
        $product = Product::create(array_filter($request->all(), function ($element, $key) {
            return !is_array($element) && $key != '_token';
        }, ARRAY_FILTER_USE_BOTH));

        /* END: updating data for product*/

        /* START: updating main data for product*/
        foreach ($request['product_description'] as $product_description) {
            ProductDescription::updateOrInsert(
                [
                    'product_id' => $product['id'],
                    'language_id' => $product_description['language_id']
                ],
                $product_description
            );
        }

        ProductDescription::where('product_id', $product['id'])->whereNotIn('language_id', array_keys($request['product_description']))->delete();
        /* END: updating main data for product*/

        /* START: updating relations data for product*/
        if (!empty($request['productTo1C']['1c_id'])) {
            $product->productTo1C()->updateOrInsert(
                [ 'product_id' => $product['id'] ],
                [ '1c_id' => $request['productTo1C']['1c_id']]
            );
        }
        /* END: updating relations data for product*/

        /* START: updating images data for product*/

        /* END: updating images data for product*/

        /* START: updating apts data for product*/
        ProductApts::where('product_id', $product['id'])->delete();
        if (!empty($request['product_apt'])) {
            foreach ($request['product_apt'] as $product_apt) {
                ProductApts::insert(array_merge(['product_id' => $product['id']], $product_apt));
            }
        }
        /* END: updating apts data for product*/

        return redirect()->route('admin.products.updateProductNew', ['id' => $product['id']])->with('success','Товар был успешно создан!');
    }

    public function getProd($id){
        $product = Product::find($id);
        if (empty($product)) {
            abort(404);
        }

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


    public function updateProduct(ProductUpdate $request, $id){

        $product = Product::find($id);
        if (empty($product)) {
            abort(404);
        }
        /* START: updating main data for product*/
        foreach ($request['product_description'] as $product_description) {
            ProductDescription::updateOrInsert(
                [
                    'product_id' => $id,
                    'language_id' => $product_description['language_id']
                ],
                $product_description
            );
        }

        ProductDescription::where('product_id', $id)->whereNotIn('language_id', array_keys($request['product_description']))->delete();
        /* END: updating main data for product*/

        /* START: updating data for product*/
        $product->update(array_filter($request->all(), function ($element, $key) {
            return !is_array($element) && $key != '_token';
        }, ARRAY_FILTER_USE_BOTH));
        /* END: updating data for product*/

        /* START: updating relations data for product*/
        if (!empty($request['productTo1C']['1c_id'])) {
            $product->productTo1C()->updateOrInsert(
                [ 'product_id' => $id ],
                [ '1c_id' => $request['productTo1C']['1c_id']]
            );
        }
        /* END: updating relations data for product*/

        /* START: updating images data for product*/

        /* END: updating images data for product*/

        /* START: updating apts data for product*/
        ProductApts::where('product_id', $id)->delete();
        if (!empty($request['product_apt'])) {
            foreach ($request['product_apt'] as $product_apt) {
                ProductApts::insert(array_merge(['product_id' => $id], $product_apt));
            }
        }
        /* END: updating apts data for product*/

        return back()->with('success','Товар был успешно обновлен!');
    }

    public function information(){
        return view('admin.products.information');
    }
    public function changeInformation(){
        return view('admin.products.changeInformation');
    }

    public function deleteProd(Request $request)
    {
        $ids = json_decode($request->input('ids'));

        foreach ($ids as $product) {
            Product::where('id', $product)->delete();
            ProductDescription::where('product_id', $product)->delete();
            ProductImages::where('product_id', $product)->delete();
            ProductsAttributes::where('product_id', $product)->delete();
            ProductTo1C::where('product_id', $product)->delete();

        }
        return response()->json(['success' => 1]);
    }
}
