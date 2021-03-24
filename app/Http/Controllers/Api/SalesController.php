<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Products\GlobalSales;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SalesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getGlobalSales()
    {
        $globalSales = GlobalSales::all()
            ->sortBy('sum_modal');

        return response()->json($globalSales);
    }
}
