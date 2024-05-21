<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class UserVerificationController extends Controller
{
    public function generateOTP()
    {
        $otp = rand(100000, 999999);
        return $otp;
    }

    public function sendVerificationCode()
    {
        
        $user = Auth::guard('api')->user();
        $otp = $this->generateOTP();
        
        Cache::put($user->email, $otp, now()->addHours(1));
        Mail::to($user->email)->send(new OTPMail($otp));

        return response()->json(['message' => 'OTP sent successfully', 'status' => 200]);
    }

    public function resendVerificationCode(Request $request)
    {
        $user = Auth::guard('api')->user();
        $otp = $this->generateOTP();

        Cache::put($user->email, $otp, now()->addHours(1));

        Mail::to($user->email)->send(new OTPMail($otp));

        return response()->json(['message' => 'OTP resent successfully'], 200);
    }

    public function verifyCode(Request $request)
    {
        $user = Auth::guard('api')->user();
        $enteredOTP = $request->input('code');
        $storedOTP = Cache::get($user->email);

        if ($enteredOTP == $storedOTP) {
            $user->email_verified_at = Carbon::now();
            $user->save();
            return response()->json(['message' => 'OTP verified successfully', 'status' => 200, 'user' => UserResource::make($user)]);
        } else {
            return response()->json(['error' => 'Invalid OTP', 'status' => 401]);
        }
    }
}
