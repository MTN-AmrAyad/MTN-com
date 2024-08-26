<?php

namespace App\Http\Controllers\Survay;

use App\Http\Controllers\Controller;
use App\Models\Survay\CtrlOrganicAug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CtrlOrganicAugController extends Controller
{
    //create the survay
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'country_code' => 'required|string',
            'phoneNumber' => 'required|string|unique:ctrl_organic_augs,phoneNumber',

        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = CtrlOrganicAug::create($request->all());
        return response()->json([
            "message" => "data stored successfully",
            "data" => $data
        ], 201);
    }

    //function to retrieve all data
    public function index()
    {
        $data = CtrlOrganicAug::all();
        return response()->json([
            "message" => "data retrieved successfully",
            "data" => $data
        ], 201);
    }
}
