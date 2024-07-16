<?php

namespace App\Http\Controllers;

use App\Models\EBM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EBMController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:e_b_m_s,client_email",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:e_b_m_s,client_phone",
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        EBM::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "successfully created",
        ], 201);
    }

    public function index()
    {
        $data =  EBM::all();
        return response()->json([
            "message" => true,
            "data" => $data,
        ]);
    }
}
