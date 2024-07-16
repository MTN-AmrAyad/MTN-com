<?php

namespace App\Http\Controllers;

use App\Models\Bfh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BfhController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:bfhs,client_email",
            "client_country" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:bfhs,client_phone",
            "courseName" => "required",
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        Bfh::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "successfully created",
        ], 201);
    }

    public function index()
    {
        $data =  Bfh::all();
        return response()->json([
            "message" => true,
            "data" => $data,
        ]);
    }
}
