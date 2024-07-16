<?php

namespace App\Http\Controllers;

use App\Models\CtrlAnatomicalOutLineFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CtrlAnatomicalOutLineFeedController extends Controller
{
    public function index()
    {
        $data = CtrlAnatomicalOutLineFeed::all();
        return response()->json([
            "message" => "CtrlAnatomicalOutLineFeed retrieved successfully",
            "data" => $data
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:ctrl_anatomical_out_line_feeds,client_phone",
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        CtrlAnatomicalOutLineFeed::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "successfully created",
        ], 201);
    }
}
