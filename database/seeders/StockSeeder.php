<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->hasStock(5)->create();
    }
}
