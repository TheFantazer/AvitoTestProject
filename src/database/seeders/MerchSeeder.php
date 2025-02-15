<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/MerchSeeder.php
    public function run()
    {
        DB::table('merch')->insert([
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
        ]);
    }
}
