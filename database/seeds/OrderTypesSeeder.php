<?php

use Illuminate\Database\Seeder;

class OrderTypesSeeder extends Seeder
{
    protected $names = [
        'active',
        'payment_process',
        'shipping_process',
        'finish',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->truncate();

        foreach ($this->names as $name) {
            $orderStatus = new \App\Models\OrderStatuses();
            $orderStatus->name = $name;

            $orderStatus->save();
        }
    }
}
