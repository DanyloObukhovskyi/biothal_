<?php


namespace App\Services;


use App\Models\Payment;
use Illuminate\Support\Facades\Crypt;

class PortmoneService
{
    public const GETAWAY_URL = 'https://www.portmone.com.ua/gateway/';

    public function makeRequest($amount, $order)
    {
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->amount = $amount;
        $payment->status = Payment::STATUS_PENDING;
        $payment->save();

        $url = self::GETAWAY_URL . '?' . http_build_query([
                'payee_id' => env('PORTMONE_SHOP_ID'),
                'shop_order_number' => $payment->id,
                'bill_amount' => $payment->amount,
                'description' => env('PORTMONE_DESCRIPTION'),
                'success_url' => '',
                'failure_url' => '',
                'lang' => 'ru',
                'encoding' => 'UTF-8',
                'exp_time' => '400'
            ]);

        return $url;
    }
}
