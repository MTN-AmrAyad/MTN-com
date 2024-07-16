<?php

namespace App\Http\Controllers;

use App\Models\RagelKaseb;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RagelKasebController extends Controller
{
     // function for Form in Landpage ragelKaseb
    public function ragelKaseb(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:ragel_kasebs,email',
            'phone' => 'required|unique:ragel_kasebs,phone',
            'job' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'You Already registered with your phone or email ',
            ], 501);
        } else {
            
            RagelKasebController::sendMessage($request);
            RagelKaseb::create($request->all());
            return response()->json([
                'message' => 'Regisration Successfully submitted',
            ], 201);
        }
    }
    // Retrive data form ragelKaseb from database
    public function review()
    {
        $data = RagelKaseb::all();
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $data
        ], 200);
    }
     // Function with built in api check the number of whatsapp exist or not using wo-wa 
     public function whatsapp(Request $request)
    {


        $phone_no = $request->input('phone');
        $key = '53e6845a7bc50f05f3bee7133ebe9994690f1d6aa78d56df'; //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/check_number';
        $data = array(
            "phone_no" => $phone_no,
            "key"    => $key
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        $res = curl_exec($ch);
        if ($res == "exists") {
            return response()->json([
                'message' => $res
            ], 200);
        } else {
            return response()->json([
                'message' => $res
            ], 400);
        }

        curl_close($ch);
     
    }
    
    // Function caled in the insert to send message after inserting 
    public function sendMessage(Request $request)
    {
        $phone = $request->input('phone');
        
        $key = '53e6845a7bc50f05f3bee7133ebe9994690f1d6aa78d56df'; //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/send_message';
        $message ='لقد تم تاكيد حجزك في فعاليات برنامج الراجل الكسيب

ويمكن متابعة اللقاء من خلال  الزوم من الرابط 
https://us02web.zoom.us/j/85448532315?pwd=TUNBbFlyeCtUbjZ5Q3o2UXpDS0NmQT09
او
من خلال لينكYoutube 
 https://www.youtube.com/@ManageTheNowlive

الموافق ليوم 15/3/2024

في تمام الساعة
3:00 مساء بتوقيت الامارات 
2:00 مساء بتوقيت السعودية
1:00 مساء بتوقيت القاهرة';
        $data = array(
            "phone_no"  => $phone,
            "key"       => $key,
            "message"   => $message,
            "skip_link" => True, // This optional for skip snapshot of link in message
            "flag_retry"  => "on", // This optional for retry on failed send message
            "pendingTime" => 3 // This optional for delay before send message
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        echo $res = curl_exec($ch);
        curl_close($ch);
    }
    
}
