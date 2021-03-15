<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Requests\Products\{
    Add as ProductAddRequest,
    Change as ProductChangeRequest,
    GetForChange as IdValidationRequest,
};

use App\Http\Requests\Products\Information\{
    Create as InformationCreateRequest,
    Update as InformationUpdateRequest
};

use App\Models\Admin\Products\{
    ProductDescription,
    ProductImages,
    ProductsAttributes,
    ProductTo1C,
    Information,
    InformationAttributes,
    InformationToLayout
};

use App\Models\Admin\UrlAlias;

use App\Models\{
    Image,
    Categories,
    StockStatus,
    AccessoryProducts,
    CategoryProducts,
    Admin\Products\Sale,
    Admin\Products\Product,
    Admin\Accessories\Accessories};

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
        $product = Product::find($id);
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
