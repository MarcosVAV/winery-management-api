<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    public function run()
    {
        ProductType::firstOrCreate(['name' => 'Vinho Tinto']);
        ProductType::firstOrCreate(['name' => 'Vinho Seco']);
    }
}