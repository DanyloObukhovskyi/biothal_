<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Information;
use App\Models\Admin\Products\InformationAttributes;
use App\Models\Admin\Products\InformationToLayout;
use App\Models\Admin\Products\Product;
use App\Models\Categories;
use App\Models\ImageGlobal;
use http\Env\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AddEmailForUserTable as AddEmail;
use App\Models\EmailForEmailNewsletter;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $carousel = ImageGlobal::all();
        $products = Product::with([
                'image',
                'productDescription',
                'getSale'
            ])
            ->where([
                'status' => 1
            ])
            ->whereNotNull('sale_id')
            ->orderBy('sort_order', 'ASC')
            ->paginate(9);

        return response()->json([
            'carousel' => $carousel,
            'products' => $products,
        ]);
    }

    public function products()
    {
        $products = Product::with([
                'image',
                'productDescription',
                'getSale'
            ])
            ->where([
                'status' => 1
            ])
            ->whereNotNull('sale_id')
            ->orderBy('sort_order', 'ASC')
            ->paginate(9);

        return response()->json($products);
    }

    public function bestSellers()
    {
        $bestSeller = Product::with('image', 'productDescription')
            ->where([
                'sale_id' => null,
                'status' => 1
            ])
            ->orderBy('sort_order', 'ASC')
            ->paginate(9);

        return response()->json($bestSeller);
    }

    public function menu()
    {
        $info_categories = Categories::where([
                'parent_id' => null,
                'type_category' => 1
            ])
            ->with('childrenArticle')
            ->OrderBy('ordering', 'ASC')
            ->get();

        $categories = Categories::with('children')
            ->where([
                ['parent_id', null],
                ['type_category', 0]
            ])
            ->OrderBy('ordering', 'ASC')
            ->get();

        return response()->json([
            'categories' => $categories,
            'info_categories' => $info_categories
        ]);
    }


    public function footer()
    {
        $info_categories = Categories::select('id')
            ->where('type_category', 1)
            ->OrderBy('ordering', 'ASC')
            ->get();
        $information_ids = InformationToLayout::select('information_id')->whereIn('layout_id', Arr::pluck($info_categories, 'id'))->get();
        $bottom_article = Information::whereIn('information_id', Arr::pluck($information_ids, 'information_id'))
            ->where('bottom', 1)
            ->get();

        $categories = Categories::where([
                ['parent_id', null],
                ['type_category', 0]
            ])
            ->OrderBy('ordering', 'ASC')
            ->get();
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

    public function addEmailForReceive(AddEmail $request)
    {
        EmailForEmailNewsletter::create([
            'email' => $request->email,
            'is_receive' => 0
        ]);

        return response()->json([
            'message' => 'Мы сообщим вам о новинках',
        ], 200);
    }

    public function getMainCategories()
    {
        $categories = Categories::where('parent_id', null)->get();

        return response()->json([
            'categories' => $categories,
        ], 200);
    }
}
