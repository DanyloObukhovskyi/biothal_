<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class OrderStatuses extends Model
{
    public const PENDING = 'pending';

    protected $table = "order_statuses";

    protected $guarded = [];

    public function order()
    {
        return $this->hasOne(Order::class, 'order_status_id', 'id');
    }
}
