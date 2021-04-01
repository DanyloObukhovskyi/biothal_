<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatuses;
use App\Models\Payment;
use Illuminate\Http\Request;

class PortmoneController extends Controller
{
    public function index()
    {
        return view('portmone');
    }


    public function success($order_id)
    {
        $payment = Payment::where('order_id', $order_id)
            ->first();

        $payment->status = Payment::STATUS_SUCCESS;
        $payment->save();

        return redirect(env('FRONT_APP_URL'). '/order-status/'. $order_id);
    }

    public function cancel($order_id)
    {
        $payment = Payment::where('order_id', $order_id)
            ->first();

        $payment->status = Payment::STATUS_CANCELED;
        $payment->save();

        return redirect(env('FRONT_APP_URL'). '/order-status/'. $order_id);
    }
}
