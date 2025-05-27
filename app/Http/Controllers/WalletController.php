<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class WalletController extends Controller
{
    public function topup(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1000']);

        $user = auth()->user();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'description' => 'Topup saldo'
        ]);

        return response()->json([
            'message' => 'Topup berhasil',
            'balance' => $user->balance
        ]);
    }
}

