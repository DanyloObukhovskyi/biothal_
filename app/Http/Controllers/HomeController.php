<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Information;
use App\Models\Admin\Products\InformationAttributes;
use App\Models\Admin\Products\InformationToLayout;
use App\Models\Admin\Products\Product;
use App\Models\Categories;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::with('image', 'productDescription')->where('sale_id', '!=', null)->limit(9)->paginate(9);
        $best_seller = Product::with('image', 'productDescription')->where('sale_id', '=', null)->paginate(9);

        return response()->json([
            'products' => $products,
            'best_seller' => $best_seller
        ]);
    }

    public function menu()
    {
        $categories = Categories::with('children')->where([['parent_id', null], ['type_category', 0]])->get();

        $info_categories = Categories::with('childrenArticle')->where([['parent_id', null], ['type_category', 1]])->get();

//        Релейшн
//        $information_ids = InformationToLayout::select('information_id')->whereIn('layout_id', Arr::pluck($info_categories, 'id'))->get();
//        $bottom_article = Information::whereIn('information_id', Arr::pluck($information_ids, 'information_id'))
//            ->where('bottom', 1)
//            ->get();
//        $article = InformationAttributes::whereIn('information_id', Arr::pluck($bottom_article, 'information_id'))->get();

        return response()->json([
//            'article' => $article,
            'categories' => $categories,
            'info_categories' => $info_categories
        ]);
    }


    public function footer()
    {
        $info_categories = Categories::select('id')->where('type_category', 1)->get();
        $information_ids = InformationToLayout::select('information_id')->whereIn('layout_id', Arr::pluck($info_categories, 'id'))->get();
        $bottom_article = Information::whereIn('information_id', Arr::pluck($information_ids, 'information_id'))
            ->where('bottom', 1)
            ->get();

        $categories = Categories::where([['parent_id', null], ['type_category', 0]])->get();
        $article = InformationAttributes::whereIn('information_id', Arr::pluck($bottom_article, 'information_id'))->get();

        return response()->json([
            'article' => $article,
            'categories' => $categories
        ]);
    }
    public function about()
    {
        return view('company.about');
    }

    public function sea()
    {
        return view('company.sea');
    }

    public function vod()
    {
        return view('company.vod');
    }

    public function production()
    {
        return view('company.production');
    }
}
