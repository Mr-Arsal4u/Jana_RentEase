<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create(['name' => 'USD', 'symbol' => '$','code' => 'USD']);
        Currency::create(['name' => 'EUR', 'symbol' => '€','code' => 'EUR']);
        Currency::create(['name' => 'JPY', 'symbol' => '¥','code' => 'JPY']);
    }
}
