<?php

namespace App\Http\Controllers;

use App\Models\FetraLive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FetraLiveController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:fetra_lives,client_email",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:fetra_lives,client_phone",
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        FetraLive::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "successfully created",
        ], 201);
    }

    public function index()
    {
        $data =  FetraLive::all();
        return response()->json([
            "message" => true,
            "data" => $data,
        ]);
    }
}
