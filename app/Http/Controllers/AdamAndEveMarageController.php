<?php

namespace App\Http\Controllers;

use App\Models\AdamAndEveMarage;
use App\Models\Adamevemarageqr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdamAndEveMarageController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:adam_and_eve_marage,client_email",
            "client_job" => "required|string",
            "client_country" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:adam_and_eve_marage,client_phone",
            "attendance" => "required",

        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        } else {
            $regstration = AdamAndEveMarage::create($request->all());
            return response()->json([
                'message' => 'Registration Successfully ',
                'data' => $regstration
            ], 201);
        }
    }

    public function review()
    {
        $data = AdamAndEveMarage::all();
        return response()->json([
            'message' => 'Data Retrieved successfully',
            'data' => $data
        ], 200);
    }
    
    public function QRcode($phone_number)
    {
        // Find the communication based on client phone number
        $communication = AdamAndEveMarage::where('client_phone', $phone_number)->first();

        if ($communication) {
            // Construct the final phone number
            $final_number = $communication->client_country_code . $phone_number;
            $name = $communication->client_name;
            $email = $communication->client_email;
            // $qrs = Communicationqr::where('phone', $final_number)->first();
                // Create a new CommunicationQR record if validations pass
                $newQR = Adamevemarageqr::create([
                    "name" => $name,
                    "email" => $email,
                    "phone" => $final_number,
                ]);
                // return response()->json([
                //     'status' => true,
                //     'message' => "Successfully Scanned QR Code",
                //     'data' => $newQR,
                // ]);
                return redirect('https://managethenow.com/checkqr/communication/correct');
            
        } else {
            // Handle case where no matching client is found for the given phone number
            // return response()->json([
            //         'status' => false,
            //         'message' => "Successfully Scanned QR Code",
            //         'data' => $newQR,
            //     ], 404);
                return redirect('https://managethenow.com/checkqr/communication/wrong/');
        }
    }
    
     public function getAllQRcode()
    {
        $data = Adamevemarageqr::all();
        return response()->json([
            "status" => true,
            "message" => "data retrieved successfully",
            "data" => $data
        ], 201);
    }
}
