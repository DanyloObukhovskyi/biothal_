<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange_Rate extends Model
{
    protected $table = 'exchange_rates';

    protected $fillable = [
        'id', 'created_at', 'updated_at', 'ccy', 'base_ccy', 'buy', 'sale'
    ];
}
