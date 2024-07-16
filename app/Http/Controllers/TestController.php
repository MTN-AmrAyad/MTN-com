<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class TestController extends Controller
{

   // Function caled in the insert to send message after inserting 
    public function sendMessage(Request $request )
    {
        $phoneNumber = $request->input('phone_no');
        
        
        $key = '53e6845a7bc50f05f3bee7133ebe9994690f1d6aa78d56df'; //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/send_message';
        
        
        $message ='https://managethenow.net/abdallah/SAL-ORD-2024-02079_page-0001.jpg';
        
        
        $data = array(
            "phone_no"  => $phoneNumber,
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
         $res = curl_exec($ch);
        curl_close($ch);
    }
}
