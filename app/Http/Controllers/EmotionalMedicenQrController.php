<?php

namespace App\Http\Controllers;

use App\Models\EmotionalMedicenQr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmotionalMedicenQrController extends Controller
{
    //function to retrieve data
    public function index()
    {
        $data = EmotionalMedicenQr::all();
        return response()->json([
            "message" => "data retrieved successfully",
            "data" => $data
        ], 201);
    }

    //function to insert data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_phone" => "required|unique:emotional_medicen_qrs,client_phone ",
            "client_country_phone" => "required",
            "client_job" => "required|string",
            "client_age" => "required|string",
            "howDoYouHeardAboutLecture" => "required|string",
            "didYouKnowDrAhmedBefore" => "required|string",
            "whatSocialNetworks" => "required|string",
            "whatIsYourOpinionInLecture" => "required|string",
            "q1" => "required|string",
            "q2" => "required|string",
            "q3" => "required|string",

        ])->stopOnFirstFailure();
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json([
                'error' => $firstError
            ], 422);
        }
        EmotionalMedicenQr::create($request->all());
        return response()->json([
            "message" => "data inserted successfully",

        ], 201);
    }
}
