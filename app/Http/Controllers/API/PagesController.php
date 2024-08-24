<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Page;
use App\Models\User;
use App\Notifications\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class PagesController extends Controller
{
    public function faq(Request $request){
        return response()->json(
            ['success'=>true, 'faqs'=>FAQ::all()]
        ) ;
    }
    public function pages(Request $request){
        return response()->json(
            ['success'=>true, 'pages'=>Page::all()]
        ) ;
    }

    public function contact(Request $request){
        $validated = Validator::make($request->all(), [
            "user_name" => 'required',
            "email" => "required",
            "phone" => "required",
            "subject" => 'required',
            "content" => 'required'
        ]);


        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        }

        $user_name = $request->user_name;
        $phone = $request->phone;
        $email = $request->email;
        $subject = $request->subject;
        $content = $request->content;
        $details['greeting'] = 'Dear Admin';
        $details['subject'] = 'New Contact US Request';
        $details['body'] = "<p>Name : {$user_name}</p> <p>Phone : {$phone}</p><p>Email : {$email}</p><p>Subject : {$subject}</p><p>Content : {$content}</p>";
        $admin = User::where('role', 'admin')->get();
        try{
            Notification::send($admin, new SendMail($details));
        }catch(\Exception $e){
        }
        return response(['success'=>true,
        'message' => 'Message Sent Successfully']);
    }
}
