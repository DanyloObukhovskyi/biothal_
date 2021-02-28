<?php

namespace App\Models;

use App\Models\OrderHistory;
use App\Models\ShoppingCart;
use App\Models\OrderStatuses;
use App\Models\UserOrderAddress;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";

    protected $guarded = [];

    public function userAddress()
    {
        return $this->belongsTo(UserOrderAddress::class, 'user_order_id');
    }

    public function productHistory () {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }

    public function orderStatus () {
        return $this->belongsTo(OrderStatuses::class, 'order_status_id');
    }

    public function shoppingCart()
    {
        return $this->hasOneThrough(
            ShoppingCart::class,
            UserOrderAddress::class,
            'id', // Foreign key on the cars table...
            'id', // Foreign key on the owners table...
            'user_order_id', // Local key on the mechanics table...
            'shopping_id' // Local key on the cars table...
        );
    }

}
