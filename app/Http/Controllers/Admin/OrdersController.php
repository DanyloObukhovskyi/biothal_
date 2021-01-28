<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use DataTables;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $statuses = ShoppingCart::STATUS;
        return view('admin.orders.orders', [
            'statuses' => $statuses,
        ]);
    }
}
