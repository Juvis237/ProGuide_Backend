<?php

namespace App\Http\Controllers\API;

// use auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * LOGIN
     * Endpoint to login a user
     * 
     * @queryParam email required  User email
     * @queryParam password required  User Password
     *@request /login?email=email&password=PASSWORD
     *@method POST

     */
    public function login(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validated->fails()) {
            return response(['success'=>false,'message' => $validated->errors()->first()]);
        }

        if (!(auth()->attempt($request->all()))) {
            return response([
                'message' => "User email number or password not correct",
                "success" => false,
            ]);

        }

        $user = User::where(['email' => $request->email])->first();

        Auth::guard('api')->check($user);

        if (isset($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('authToken')->accessToken;

            if ($token) {
                return response([
                    "message" => "User authentication successful",
                    'success' => true,
                    'user' => \App\Http\Resources\UserResource::make($user),
                    'token' => $token,
                ], 200);
            } else {
                return response([
                    'message' => "Server error,Please try again",
                    "success" => false
                ]);
            }
        }

    }

    /**
     * Agent Login
     * Endpoint to login a user
     * 
     * @queryParam email required  User email
     * @queryParam password required  User Password
     *@request /agent/login?email=email&password=PASSWORD
     *@method POST

     */
    public function agentLogin(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validated->fails()) {
            return response(['success'=>false,'message' => $validated->errors()->first()]);
        }

        if (!(auth()->attempt($request->all()))) {
            return response([
                'message' => "User email number or password not correct",
                "success" => false,
            ]);

        }

        $user = User::where(['email' => $request->email])->first();

        Auth::guard('api')->check($user);

        if (isset($user) && Hash::check($request->password, $user->password) && $user->isAgent()) {
            $token = $user->createToken('authToken')->accessToken;

            if ($token) {
                return response([
                    "message" => "User authentication successful",
                    'success' => true,
                    'user' => \App\Http\Resources\UserResource::make($user),
                    'token' => $token,
                ], 200);
            } else {
                return response([
                    'message' => "Server error,Please try again",
                    "success" => false
                ]);
            }
        }

    }

    public function generate()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, 8);
    }


    /**
     *Register

     * REGISTER
     * Endpoint to register a new user to the system
     
     * @queryParam email required  User email
     * @queryParam user_name required  User name
     * @queryParam phone nullable  User Email
     * @queryParam password required  User Password
     *@request /register?email=email&password=PASSWORD
     *@method POST

     */
    public function register(Request $request)
    {

        $validated = Validator::make($request->all(),[
            "email" => 'required',
            "phone" => "nullable",
            "password" => 'required',
            "user_name"=> "required",
            "role" => "required",
            "referal_code" => "nullable",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        };

        $result = User::where(['email' => $request->email])->first();

        if($result){
            return response([
                "message" => "email  already taken, Please try again with a different email",
                'success' => false,
            ]);
        }

        $user = User::create(
            [
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => $request->role,
            'referal_code' => $this->generate(),
            'refered_by' => User::where('referal_code', $request->referal_code)->first()?->id
            ]);

        Auth::guard('api')->check($user);

        $token = $user->createToken('authToken')->accessToken;
        Wallet::create([
            'user_id'=> $user->id
        ]);
        $details['greeting'] = 'Dear '.$user->name;
        $details['subject'] = 'Welcome To Proguide';
        $details['body'] = "<p>Welcome to Proguide, go forth and apply for a document on the platform, make sure you refer a friend";
        
        try{
            Notification::send($user, new SendMail($details));
        }catch(\Exception $e){
        }

       if ($token) {
            return response([
                "message" => "User created successfully",
                'success' => true,
                'user' => UserResource::make($user),
                'token' => $token

            ], 200);
        } else {
             return response([
                'message' => "Server error,Please try again",
                "success" => false,
            ]);
        }

    }

}
