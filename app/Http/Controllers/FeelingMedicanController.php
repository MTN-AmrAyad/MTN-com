<?php

namespace App\Http\Controllers;

use App\Models\FeelingMedican;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeelingMedicanController extends Controller
{
    public function index()
    {
        $data = FeelingMedican::all();
        return response()->json([
            "message" => "FeelingMedican retrieved successfully",
            "data" => $data
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:feeling_medicans,client_phone",
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        FeelingMedican::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "successfully created",
        ], 201);
    }
}
