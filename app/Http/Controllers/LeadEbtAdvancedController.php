<?php

namespace App\Http\Controllers;

use App\Models\LeadEbtAdvanced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadEbtAdvancedController extends Controller
{
    //
    public function index()
    {
        $data = LeadEbtAdvanced::all();
        return response()->json([
            "message" => "data get success",
            "data" => $data
        ]);
    }
    public function store(Request $request)
    { // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "client_name" => "required",
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
        $data = LeadEbtAdvanced::create($request->all());
        return response()->json($data);
    }
}
