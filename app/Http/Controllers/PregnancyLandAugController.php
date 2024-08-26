<?php

namespace App\Http\Controllers;

use App\Models\PregnancyLandAug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PregnancyLandAugController extends Controller
{
    //
    // function to retrive all date
    public function index()
    {
        $data = PregnancyLandAug::all();
        return response()->json([
            "message" => "date retrieved successfully",
            "data" => $data
        ], 201);
    }

    // function to store date
    public function store(Request $request)
    {
        // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "client_name" => "required",
            "client_country" => "required",
            "client_country_code" => "required",
            "client_phone" => "required",
            "client_email" => "required",
        ])->stopOnFirstFailure();
        //check the Validation if failed
        if ($valdiator->fails()) {
            //get the first error message
            $firstError = $valdiator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        //inserting data into the database
        $clientInfo = PregnancyLandAug::create($request->all());
        // return the respon to get the id of the client
        return response()->json([
            "message" => "data inserted successfully",
            "clientInfo" => $clientInfo
        ], 201);
    }
}
