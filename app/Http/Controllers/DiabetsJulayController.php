<?php

namespace App\Http\Controllers;

use App\Models\DiabetsJulay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiabetsJulayController extends Controller
{
    //function to retrieve data
    public function index()
    {
        $data = DiabetsJulay::all();
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
            "client_phone" => "required|unique:diabets_julays,client_phone",
            "client_country_code" => "required",
            "client_email" => "required|unique:diabets_julays,client_email",
            "client_country" => "required",
        ])->stopOnFirstFailure();
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json([
                'error' => $firstError
            ], 422);
        }
        DiabetsJulay::create($request->all());
        return response()->json([
            "message" => "data inserted successfully",

        ], 201);
    }
}
