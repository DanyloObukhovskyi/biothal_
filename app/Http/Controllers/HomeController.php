<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use App\Models\Categories;
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
        $categories = Categories::with('children')->where('parent_id', null)->get();

        return response()->json([
            'categories' => $categories
        ]);
    }


    public function footer()
    {
        $categories = Categories::where('parent_id', null)->get();

        return response()->json([
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
