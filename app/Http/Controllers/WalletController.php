<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public User $user;
    public function __construct()
    {
        $this->user = Auth::guard('api')->user();
    }
    //
    public function balance(Request $request){
        $wallet = Wallet::where('user_id', $this->user->id)->first();

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
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $wallet = Wallet::where('user_id', $this->user->id)->first();
        
        $balanceBefore = $wallet->balance;
        $balanceAfter = $balanceBefore - $request->amount;

        if ($balanceAfter < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance.',
            ], 400);
        }

        $expense = Expenses::create([
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
        $wallet = Wallet::where('user_id', $this->user->id)->first();

        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'Wallet not found for the specified user ID.',
            ], 404);
        }

        $transactions = Expenses::where('wallet_id', $wallet->id)->get();

        return response()->json([
            'success' => true,
            'transactions' => $transactions,
        ]);
    }
}