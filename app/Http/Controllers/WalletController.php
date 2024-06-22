<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Expenses;

class WalletController extends Controller
{
    //
    public function balance(Request $request){
        $user_id = $request->user_id;
        $wallet = Wallet::where('user_id', $user_id)->first();

        if ($wallet) {
            return response()->json([
                'success' => true,
                'balance' => $wallet->balance,
            ]);
        } else {
            // Wallet is not found
            return response()->json([
                'success' => false,
                'message' => 'Wallet not found for the specified user ID.',
            ], 404);
        }
    }

    public function addExpense(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $wallet = Wallet::where('user_id', $request->user_id)->firstOrFail();
        
        $balanceBefore = $wallet->balance;
        $balanceAfter = $balanceBefore - $request->amount;

        if ($balanceAfter < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance.',
            ], 400);
        }

        $expense = Expense::create([
            'wallet_id' => $wallet->id,
            'amount' => $request->amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $balanceAfter,
            'description' => $request->description,
        ]);

        $wallet->update(['balance' => $balanceAfter]);

        return response()->json([
            'success' => true,
            'expense' => $expense,
        ]);
    }

    public function transactions(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user_id = $request->user_id;
        $wallet = Wallet::where('user_id', $user_id)->first();

        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'Wallet not found for the specified user ID.',
            ], 404);
        }

        $transactions = Expense::where('wallet_id', $wallet->id)->get();

        return response()->json([
            'success' => true,
            'transactions' => $transactions,
        ]);
    }
}