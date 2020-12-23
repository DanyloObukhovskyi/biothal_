<?php

namespace App\Models\Admin\Products;

use Illuminate\Database\Eloquent\Model;

class GlobalSales extends Model
{
    protected $table = 'global_sales';

    protected $fillable = [
        'sum_modal', 'procent_modal'
    ];

    public $timestamps = FALSE;
}
