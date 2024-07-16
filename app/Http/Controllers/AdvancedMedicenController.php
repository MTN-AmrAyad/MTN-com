<?php

namespace App\Http\Controllers;

use App\Models\AdvancedMedicen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdamEveTrainingEvaluation;

use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class AdvancedMedicenController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:advanced_medicen,client_email",
            "client_country" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:advanced_medicen,client_phone",

        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
         $modifiedName = str_replace(' ', '_', $request->client_name);
        // $regstration = AdvancedMedicen::create($request->all());
        $regstration = AdvancedMedicen::create([
            "client_name"=>$modifiedName,
            "client_email"=>$request->client_email,
            "client_country"=>$request->client_country,
            "client_country_code"=>$request->client_country_code,
            "client_phone"=>$request->client_phone,
            ]);
        if(!$regstration){
                return response()->json([
                'message' => 'Error in Query ',
            ], 403);
            }else{
                $id=$regstration->id;
                $client_name=$regstration->client_name;
            AdvancedMedicenController::sendMessage($request , $id,$client_name);
            // after create the lead from landpage login to ERP to get credintials
            AdvancedMedicenController::ERPLogin($request);
            }
            
            $response=[
                "id"=>$regstration->id,
                "name"=>$regstration->client_name,
            
                ];
        return response()->json($response,201);
    }
    public function review()
    {
        $data = AdvancedMedicen::all();
        return response()->json([
            "status" => true,
            "message" => "data retrieved successfully",
            "data" => $data
        ]);
    }
    
     // login to ERP and insert lead from form to ERP Lead
    public function ERPLogin(Request $request)
    {
        $finalphone = $request->client_country_code . $request->client_phone;
        $response = Http::withHeaders([
            'Authorization' => 'Basic NWE4ZjBhODU3YjIyYWJmOmUxOWU3OGMxMjQ2MDY0OQ==',
        ])->post('https://mtn.smartsoleg.com/api/resource/Lead', [
            "project" => "future-medicine",
            "lead_name" => $request->client_name,
            "lead_country" => $request->client_country,
            "phone" => $finalphone,
            "email_id" => $request->client_email,

        ]);
    }
    
   // Function caled in the insert to send message after inserting 
    public function sendMessage(Request $request , $id,$client_name)
    {
        $phoneNumber = $request->input('client_phone');
        $codeNumber = $request->input('client_country_code');
        $phone=$codeNumber.$phoneNumber;
        
        $key = '53e6845a7bc50f05f3bee7133ebe9994690f1d6aa78d56df'; //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/send_message';
        $message ='🌟لقد تم تأكيد حجزك 
في ( محاضرة جماهيرية مفتوحة بعنوان 
طب المستقبل ) 
مع ( دكتور أحمد الدملاوي) 
يوم 31/5/2024

من الساعة 5:00 إلي 6:30 مساء (بتوقيت المغرب)

رقم المقعد :  '.$id.'

تذكرتك : 

https://managethenow.com/forms/future-medicine/ticket?id='.$id.'&name='.$client_name.'

💥ونحيطكم علما بأن الحضور متاح مباشر فقط 👇🏻
📍فندق 
Club Val d’Anfa Hotel
📌اللوكيشن 👇🏻
https://maps.app.goo.gl/CiCNNzXpAEPpnSvU8?g_st=iw';
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
         $res = curl_exec($ch);
        curl_close($ch);
    }
}
