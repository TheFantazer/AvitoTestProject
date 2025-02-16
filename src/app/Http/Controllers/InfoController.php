<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InfoController extends Controller
{
    public function info()
    {
        $user = auth()->user();

        $inventory = $user->inventory()->with('product')->get();
        $transactions = $user->transactions;

        return response()->json([
            'coins' => $user->coins,
            'inventory' => $inventory,
            'coinHistory' => [
                'received' => $transactions->where('to_user_id', $user->id),
                'sent' => $transactions->where('from_user_id', $user->id),
            ],
        ]);
    }
}
