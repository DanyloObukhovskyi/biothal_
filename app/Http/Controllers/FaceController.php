<?php

namespace App\Http\Controllers;
use App\Models\Admin\Products\Product;

class FaceController extends Controller
{
    public function getAllCategory()
    {
        $face = Product::query()->with('getImage');
        return view('face', compact('face'));
    }

}
