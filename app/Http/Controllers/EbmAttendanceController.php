<?php

namespace App\Http\Controllers;

use App\Models\EbmAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EbmAttendanceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:embattendanc,client_email",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:embattendanc,client_phone",
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        EbmAttendance::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "successfully created",
        ], 201);
    }
    public function index()
    {
        $data =  EbmAttendance::all();
        return response()->json([
            "message" => true,
            "data" => $data,
        ]);
    }
}
