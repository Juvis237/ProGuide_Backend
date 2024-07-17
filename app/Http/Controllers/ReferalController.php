<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class ReferalController extends Controller
{
    //
    public User $user;

    public function __construct(){
        $this->user = Auth::guard('api')->user();
    }

    public function get_referrals()
    {
        // $user = Auth::guard('api')->user();

        if (!$this->$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $referrals = User::where('refered_by', $this->user->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => UserResource::collection($referrals)
        ], 200);
    }
}
