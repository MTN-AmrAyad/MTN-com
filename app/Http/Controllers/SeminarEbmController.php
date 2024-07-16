<?php

namespace App\Http\Controllers;

use App\Models\SeminarEbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class SeminarEbmController extends Controller
{
    //get all data
    public function index()
    {
        $data = SeminarEbm::all();
        return response()->json($data, 201);
    }

    //store data with validation
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [

            "client_name" => "required",
            "client_email" => "required|string|unique:seminar_ebms,client_email",
            "client_country_code" => "required",
            "client_phone" => "required|string|unique:seminar_ebms,client_phone",
            "client_country" => "required",
            "attendance" => "required",
        ])->stopOnFirstFailure();

        // Check for validation errors
        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        $phone = $request->client_country_code . $request->client_phone;
        $data = SeminarEbm::create($request->all());
        // SeminarEbmController::ERPLogin($request);
        // SeminarEbmController::sendMessage($request , $phone);
        return response()->json([
            "message" => "data created successfully"
        ], 201);
    }

    // login to ERP and insert lead from form to ERP Lead
    public function ERPLogin(Request $request)
    {
        $finalphone = $request->client_country_code . $request->client_phone;
        $response = Http::withHeaders([
            'Authorization' => 'Basic NWE4ZjBhODU3YjIyYWJmOmUxOWU3OGMxMjQ2MDY0OQ==',
        ])->post('https://mtn.smartsoleg.com/api/resource/Lead', [
            "project" => "Emotional_medicine_(Fetra_medicin)",
            "lead_name" => $request->client_name,
            "lead_country" => $request->client_country,
            "phone" => $finalphone,
            "email_id" => $request->client_email,

        ]);
    }
    //send msseage after registration
    public function sendMessage(Request $request, $phone)
    {
        // $phoneNumber = $request->input('client_phone');
        // $codeNumber = $request->input('client_country_code');
        $phone = $phone;

        $key = '53e6845a7bc50f05f3bee7133ebe9994690f1d6aa78d56df'; //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/send_message';
        $message = 'شكرا لتسجيلك معنا في EBM Seminar
رابط الحضور  من خلال الزوم
https://us02web.zoom.us/j/81863695801?pwd=bEGCaDuQPTJgfTuQIk6kBy1w8RyHkN.1';
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
