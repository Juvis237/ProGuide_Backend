<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserService;
use App\Models\UserServiceSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public User $user;

    /**
     *Get profile of authenticated user
     * @method GET
     */
    public function show(Request $request)
    {

        $user = $request->user();
        return response(['user' => new UserResource($user), 'success' => true], 200);
    }

    /**
     *Update users profile
     *
     * @queryParam first_name nullable  User First name
     * @queryParam last_name nullable  User Last name
     *@request /update_profile
     * @method POST
     */

    public function update(Request $request)
    {
        
        $this->user = Auth::guard('api')->user();
        $validated = Validator::make($request->all(), [
            "first_name" => "nullable",
            "last_name" => "nullable",
            'user_name' => "nullable",
            'phone' => "nullable",
            'image' => "nullable|file",
        ]);

        if ($validated->fails()) {
            return response(['success' => false,
                'message' => $validated->errors()->first()
            ]);
        };

        $data = $request->all();

        if (isset($request->image)) {
            $data['profile'] = $request->image->store('profiles');
        }
        
        $this->user->update($data);
        return response()->json([
            'user' => UserResource::make($this->user),
            'message' => 'Profile Updated Successfully',
            'success' => true
        ], 200);
    }


    public function changePassword(Request $request){

        $validated = Validator::make($request->all(), [
            "password" => "required|string",
            "oldPassword" => "required|string"
        ]);

        if ($validated->fails()) {
            return response(['message' => $validated->errors()->first()], 400);
        }

       
        $user = $request->user();
        if(!Hash::compare(Hash::make($request->oldPassword), $user->password)){
            return response([
                'message' => 'Old password not correct',
            ], 500);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response([
            'status'=> 'success'
        ]);
    }



    


    public function notifications(Request $request)
    {
        $this->user = Auth::guard('api')->user();
        return response()->json([
            'success' => 'true',
            'message' => "",
            'notifications' => $this->user->notifications
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('api')->user()->token()->revoke();
        return response()->json([
            'success' => 'true',
            'message' => "Logged out Successfully",
        ]);;
    }

    public function updateToken(Request $request)
    {
        $user = Auth::guard('api')->user();

        if(!$user) {
            return response()->json([
                'success' => 300,
                'message' => 'Invalid user'
            ]);
        }
        $user->fcm_token = $request->token;
        $user->save();

        return response()->json(['status' => 200]);
    }

    public function delete(Request $request){
        $user = $request->user();
        Auth::logout();
        $user->delete();
        return response()->json(['message' => 'User successfully deleted']);
    }
    
}
