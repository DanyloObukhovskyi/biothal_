<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Requests\Products\{
    Create as ProductCreate,
    Update as ProductUpdate
};

use App\Http\Requests\Products\Information\{
    Create as InformationCreateRequest,
    Update as InformationUpdateRequest
};

use App\Models\Admin\Products\{
    ProductApts,
    ProductTo1C,
    ProductImages,
    ProductsAttributes,
    ProductDescription,
    Information,
    InformationAttributes,
    InformationToLayout
};

use App\Models\Admin\UrlAlias;

use App\Models\{Categories, CategoryProducts, Image, StockStatus, Admin\Products\Product};

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
        if(isset($request['product_image'])){
            ProductImages::where('product_id', $product['id'])->delete();
            foreach($request['product_image'] as $productImage){
                if(!empty($productImage['image'])){
                    ProductImages::create([
                        'product_id' => $product['id'],
                        'image' => $productImage['image'],
                        'sort_order' => $productImage['sort_order'] ?? null
                    ]);
                }
            }
        }
        ProductDescription::where('product_id', $product['id'])->whereNotIn('language_id', array_keys($request['product_description']))->delete();
        /* END: updating main data for product*/

        /* START: updating categories data for product*/
        foreach ($request['categoryProducts'] as $product_category) {
            CategoryProducts::insert(
                [
                    'product_id' => $product['id'],
                    'category_id' => $product_category
                ]
            );
        }
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
        $images = Image::paginate(15);
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
            'categories',
            'images'
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
        if(isset($request['product_image'])){
            ProductImages::where('product_id', $product['id'])->delete();
            foreach($request['product_image'] as $productImage){
                if(!empty($productImage['image'])){
                    ProductImages::create([
                        'product_id' => $product['id'],
                        'image' => $productImage['image'],
                        'sort_order' => $productImage['sort_order'] ?? null
                    ]);
                }
            }
        }
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

        /* START: updating categories data for product*/
        foreach ($request['categoryProducts'] as $product_category) {
            CategoryProducts::where('product_id', '=', $product['id'])->delete();

            CategoryProducts::insert(
                [
                    'product_id' => $product['id'],
                    'category_id' => $product_category
                ]
            );
        }
        /* END: updating categories data for product*/

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
        $articles = Information::paginate(10);

        return view('admin.products.information', compact(
            'articles'
        ));
    }

    public function changeInformation($id){
        $article = Information::where('information_id', $id)->first();

        $url = UrlAlias::where([
            'type' => 'information',
            'query' => $id
        ])->first();

        return view('admin.products.changeInformation', compact(
            'article',
                    'url'
        ));
    }

    public function createInformation(){
        return view('admin.products.createInformation');
    }

    public function updateInformation(InformationUpdateRequest $request, $id){
        $article = Information::where('information_id', $id)->first();

        if(empty($article)){
            abort(404);
        }

        $article->bottom = isset($request->bottom) ? true : false;
        $article->sort_order = $request->sort_order;
        $article->status = $request->status;
        $article->save();

        $articleAttributes = InformationAttributes::where('information_id', $id)->first();
        $articleAttributes->title = $request->title;
        $articleAttributes->description = $request->description;
        $articleAttributes->meta_title = $request->meta_title;
        $articleAttributes->meta_description = $request->meta_description;
        $articleAttributes->meta_keywords = $request->meta_keywords;
        $articleAttributes->save();

        $articleLayout = InformationToLayout::where('information_id', $id)->first();
        $articleLayout->layout_id = $request->information_layout;
        $articleLayout->save();

        if(isset($request->keyword)){
            $url = UrlAlias::where([
                'type' => 'information',
                'query' => $id
            ])->first();
            if(!empty($url)){
                $url->keyword = $request->keyword;
                $url->save();
            } else {
                UrlAlias::create([
                    'type' => 'information',
                    'query' => $id,
                    'keyword' => $request->keyword
                ]);
            }
        }

        return redirect()->back()->with('success', 'Вы успешно обновили статью');
    }

    public function saveInformation(InformationCreateRequest $request){
        $article = Information::create([
            'bottom' => isset($request->bottom) ? true : false,
            'sort_order' => $request->sort_order,
            'status' => $request->status
        ]);

        InformationAttributes::create([
            'information_id' => $article->information_id,
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords
        ]);

        InformationToLayout::create([
            'information_id' => $article->information_id,
            'store_id' => 0,
            'layout_id' => $request->information_layout
        ]);

        if(isset($request->keyword)){
            UrlAlias::create([
                'type' => 'information',
                'query' => $article->information_id,
                'keyword' => $request->keyword
            ]);
        }

        return redirect('admin/products/changeInformation/'.$article->information_id)->with('success', 'Вы успешно создали статью');
    }

    public function deleteInformation(Request $request)
    {
        $ids = json_decode($request->input('ids'));
        foreach ($ids as $information) {
            Information::where('information_id', $information)->delete();
            InformationAttributes::where('information_id', $information)->delete();
            InformationToLayout::where('information_id', $information)->delete();
            UrlAlias::where([
                'type' => 'information',
                'query' => $information
            ])->delete();

        }
        return response()->json(['success' => 1]);
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
