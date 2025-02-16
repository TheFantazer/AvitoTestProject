<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
class CoinController extends Controller
{
    public function transfer(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
        ]);

        $fromUser = $request->user();
        $toUser = User::find($request->to_user_id);

        if ($fromUser->balance < $request->amount) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        $fromUser->balance -= $request->amount;
        $toUser->balance += $request->amount;

        $fromUser->save();
        $toUser->save();

        Transaction::create([
            'from_user_id' => $fromUser->id,
            'to_user_id' => $toUser->id,
            'amount' => $request->amount,
            'type' => 'transfer',
        ]);

        return response()->json(['message' => 'Coins transferred successfully'], 200);
    }
}
