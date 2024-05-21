<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\UserService;
use App\Models\UserServiceSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

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
     * @method POST
     */

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            'role' => "required",
            'company' => 'required_if:role,worker',
            'photo' => "nullable|file",
            'address' => 'required_if:role,worker',
            'region' => 'required_if:role,worker',
            'city' => 'required_if:role,worker',
            'website' => 'nullable|url',
            'bio' => 'required_if:role,worker',
        ]);

        if ($validated->fails()) {
            return response(['success' => false,
                'message' => $validated->errors()->first()
            ]);
        };

        $data = $request->all();
        $data['city_id'] = $data['city'];
        $data['region_id'] = $data['region'];

        if (isset($request->photo)) {
            $data['profile'] = $request->photo->store('profiles');
        }

        unset($data['type']);

        $user = $request->user();
        $user->update($data);
        $user->refresh();
        return response()->json([
            'user' => UserResource::make($user),
            'message' => 'Profile Updated Successfully',
            'success' => true
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        info($request->all());
        $validated = Validator::make($request->all(), [
            "first_name" => "nullable",
            "last_name" => "nullable",
            'email' => "nullable",
        ]);

        if ($validated->fails()) {
            return response(['success' => false,
                'message' => $validated->errors()->first()
            ]);
        };

        $data = $request->all();

        if (isset($request->photo)) {
            $data['profile'] = $request->photo->store('profiles');
        }

        unset($data['type']);

        $user = $request->user();
        $user->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'email' => $request->email ?? $user->email,
            'profile' => $data['profile'] ?? $user->profile,
        ]);
        $user->refresh();
        return response()->json([
            'user' => UserResource::make($user),
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
        return response()->json([
            'success' => '200',
            'message' => "",
            'notifications' => NotificationRe::collection($request->user()->notifications)
        ]);
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
