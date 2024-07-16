<?php

namespace App\Http\Controllers;

use App\Models\CtrlAnatomical;
use App\Models\ctrlAnatomicalqr;
use App\Models\Communicationqr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CtrlAnatomicalController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:ctrl_antomical_attend,client_email",
            "client_job" => "required|string",
            "client_country" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:ctrl_antomical_attend,client_phone",
            "attendance" => "required",

        ])->stopOnFirstFailure();;

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        } else {
            $regstration = CtrlAnatomical::create($request->all());
            return response()->json([
                'message' => 'Registration Successfully ',
                'data' => $regstration
            ], 201);
        }
    }

    public function review()
    {
        $data = CtrlAnatomical::all();
        return response()->json([
            'message' => 'Data Retrieved successfully',
            'data' => $data
        ], 200);
    }
    
    public function QRcode($phone_number)
    {
        // Find the communication based on client phone number
        $communication = CtrlAnatomical::where('client_phone', $phone_number)->first();

        if ($communication) {
            // Construct the final phone number
            $final_number = $communication->client_country_code . $phone_number;
            $name = $communication->client_name;
            $email = $communication->client_email;
            // $qrs = Communicationqr::where('phone', $final_number)->first();
                // Create a new CommunicationQR record if validations pass
                $newQR = ctrlAnatomicalqr::create([
                    "name" => $name,
                    "email" => $email,
                    "phone" => $final_number,
                ]);
                // return response()->json([
                //     'status' => true,
                //     'message' => "Successfully Scanned QR Code",
                //     'data' => $newQR,
                // ]);
                return redirect('https://managethenow.com/checkqr/ctrl-anatomical/correct');
            
        } else {
            // Handle case where no matching client is found for the given phone number
            // return response()->json([
            //         'status' => false,
            //         'message' => "Successfully Scanned QR Code",
            //         'data' => $newQR,
            //     ], 404);
                return redirect('https://managethenow.com/checkqr/ctrl-anatomical/wrong/');
        }
    }
    
     public function getAllQRcode()
    {
        $data = ctrlAnatomicalqr::all();
        return response()->json([
            "status" => true,
            "message" => "data retrieved successfully",
            "data" => $data
        ], 201);
    }
}
