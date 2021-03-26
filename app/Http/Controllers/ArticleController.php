<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\InformationAttributes;
use App\Models\Admin\Products\InformationToLayout;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{

    public function getArticle($id){
        $layout_id = Categories::where('slug', $id)->first();
        $information_id = InformationToLayout::where('layout_id', $layout_id['id'])->first();
        if ($information_id) {
            $article = InformationAttributes::where('information_id', $information_id['information_id'])->first();
        } else {
            $article = [];
        }

        return response()->json([
            'article' => $article
        ]);
    }

    public function getArticleFromFooter($id){
        $article = InformationAttributes::where('slug', $id)->first();

        return response()->json([
            'article' => $article
        ]);
    }
}
