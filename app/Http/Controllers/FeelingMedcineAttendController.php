<?php

namespace App\Http\Controllers;

use App\Models\FeelingMedcineAttend;
use App\Models\FeelingMedican;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class FeelingMedcineAttendController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [

            "client_name" => "required",
            "client_email" => "required|string|unique:feeling_medcine_attends,client_email",
            "client_country_code" => "required",
            "client_phone" => "required|string|unique:feeling_medcine_attends,client_phone",
            "client_country" => "required",
            "section_sets" => "required",
            "chair_number" => "required",
        ])->stopOnFirstFailure();

        // Check for validation errors
        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        $phone = $request->client_country_code . $request->client_phone;
        $client_name = $request->client_name;

        $checkSet = FeelingMedcineAttend::where('section_sets', $request->section_sets)
            ->where('chair_number', $request->chair_number)->first();
        if ($checkSet) {
            return response()->json('this set is already reversed');
        }

        $dataReg = FeelingMedcineAttend::create($request->all());
        if (!$dataReg) {
            return response()->json([
                "error" => "error",
            ]);
        }
        $checkERP = FeelingMedican::where('client_phone', $request->client_phone)
            ->orWhere('client_email', $request->client_email)->first();
        if (!$checkERP) {
            FeelingMedcineAttendController::ERPLogin($request);
        }
        FeelingMedcineAttendController::sendMessage($request, $client_name, $phone);
        return response()->json([
            "message" => "Registration successfully"
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

    public function checkChair()
    {
        // Fetch all chair numbers and section sets from the FeelingMedcineAttend table
        $data = FeelingMedcineAttend::all(['chair_number', 'section_sets']);
        $dataCount = $data->count();
        // return response()->json($dataCount);

        // Initialize arrays for sections
        $sections = [
            'section1' => [],
            'section2' => [],
            'section3' => [],
            'section4' => []
        ];

        // Iterate through the data and categorize into sections based on section_sets
        foreach ($data as $record) {
            $chairNumber = $record->chair_number;
            $sectionSet = $record->section_sets;

            // Categorize chair number based on section_sets value
            switch ($sectionSet) {
                case 'section1':
                    $sections['section1'][] = $chairNumber;
                    break;
                case 'section2':
                    $sections['section2'][] = $chairNumber;
                    break;
                case 'section3':
                    $sections['section3'][] = $chairNumber;
                    break;
                case 'section4':
                    $sections['section4'][] = $chairNumber;
                    break;
            }
        }

        // Return the response
        return response()->json([
            'sections' => $sections,
            'reservedCount' => $dataCount
        ], 200);
    }


    // Function caled in the insert to send message after inserting
    public function sendMessage(Request $request, $client_name, $phone)
    {
        // $phoneNumber = $request->input('client_phone');
        // $codeNumber = $request->input('client_country_code');
        $phone = $phone;

        $key = '53e6845a7bc50f05f3bee7133ebe9994690f1d6aa78d56df'; //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/send_message';
        $message = '🌟لقد تم تأكيد حجزك
في ( محاضرة جماهيرية مفتوحة بعنوان
طب المشاعر )
مع ( دكتور أحمد الدملاوي)
يوم 14/7/2024

من الساعة 5:00 إلي 7:00 مساء (بتوقيت المغرب)

تذكرتك :

https://managethenow.com/forms/future-medicine/ticket?name=' . $client_name . '

💥ونحيطكم علما بأن الحضور متاح مباشر فقط 👇🏻
📍
قاعة المسرح بالمركب الثقافي الحسن
الدار البيضاء
📌اللوكيشن 👇🏻
https://maps.app.goo.gl/f7kSUnofaTGVKRKm6';
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
