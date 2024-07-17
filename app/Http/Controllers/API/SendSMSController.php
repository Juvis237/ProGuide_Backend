<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\sendSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SendSMSController extends Controller
{
    public function send(Request $request){
        $validated = Validator::make($request->all(), [
            'recipients' => 'required',
            'content' => 'required'
        ]);
        
        if ($validated->fails()) {
            return response()->json(['success'=>false, 'error' => $validated->errors()]);
        }
        try {
            $recipients = $request->get('recipients');
            $content = $request->content;
    
            $sms = new sendSMS();
            $response = $sms->send($recipients, $content);
            return $response;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
