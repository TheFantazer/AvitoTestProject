<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 't-shirt', 'price' => 80],
            ['name' => 'cup', 'price' => 20],
            ['name' => 'book', 'price' => 50],
            ['name' => 'pen', 'price' => 10],
            ['name' => 'powerbank', 'price' => 200],
            ['name' => 'hoody', 'price' => 300],
            ['name' => 'umbrella', 'price' => 200],
            ['name' => 'socks', 'price' => 10],
            ['name' => 'wallet', 'price' => 50],
            ['name' => 'pink-hoody', 'price' => 500],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
