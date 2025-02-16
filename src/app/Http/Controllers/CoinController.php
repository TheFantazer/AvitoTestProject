<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class CoinController extends Controller
{
    public function sendCoin(Request $request)
    {
        $request->validate([
            'toUser' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
        ]);

        $fromUser = auth()->user();
        $toUser = User::find($request->toUser);

        if ($fromUser->coins < $request->amount) {
            return response()->json(['error' => 'Not enough coins'], 400);
        }

        $fromUser->coins -= $request->amount;
        $toUser->coins += $request->amount;

        $fromUser->save();
        $toUser->save();

        Transaction::create([
            'from_user_id' => $fromUser->id,
            'to_user_id' => $toUser->id,
            'amount' => $request->amount,
        ]);

        return response()->json(['message' => 'Coins sent successfully']);
    }
}
