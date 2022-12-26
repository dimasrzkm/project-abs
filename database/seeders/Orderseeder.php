<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class Orderseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(10)->create();
        for ($i = 0; $i < 10; $i++) {
            Order::find($i + 1)->products()->attach([$i + 1 => ['amount' => 1]]);
        }
    }
}
