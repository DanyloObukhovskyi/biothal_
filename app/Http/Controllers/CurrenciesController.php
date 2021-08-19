<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Exchange_Rate;

class CurrenciesController extends Controller
{
    public function send_currencies()
    {
        $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
        $exchange_rate_model = new Exchange_Rate();
        $exchange_rate_model->ccy = $response[0]['ccy'];
        $exchange_rate_model->base_ccy = $response[0]['base_ccy'];
        $exchange_rate_model->buy = $response[0]['buy'];
        $exchange_rate_model->sale = $response[0]['sale'];
        $response->save();
    }
}
