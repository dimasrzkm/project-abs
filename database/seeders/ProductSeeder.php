<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(10)->create();
        for ($i = 0; $i < 10; $i++) {
            Product::find($i + 1)->stocks()->attach([$i + 1 => ['total' => 100]]);
        }
    }
}
