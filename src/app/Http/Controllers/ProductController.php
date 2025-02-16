<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;

class ProductController extends Controller
{
    public function buy($item)
    {
        $user = auth()->user();
        $product = Product::where('name', $item)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if ($user->coins < $product->price) {
            return response()->json(['error' => 'Not enough coins'], 400);
        }

        $user->coins -= $product->price;
        $user->save();

        $inventory = Inventory::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => 0]
        );

        $inventory->quantity += 1;
        $inventory->save();

        return response()->json(['message' => 'Product purchased successfully']);
    }
}
