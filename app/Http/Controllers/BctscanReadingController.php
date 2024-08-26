<?php

namespace App\Http\Controllers;

use App\Models\BctscanReading;
use Illuminate\Http\Request;

class BctscanReadingController extends Controller
{
    //
    public function index()
    {
        $data = BctscanReading::get();
        return response()->json([
            "message" => "data retrived successflly",
            "data" => $data
        ], 201);
    }

    public function store(Request $request)
    {
        $data = BctscanReading::create($request->all());
        return response()->json([
            "message" => "data created successflly",
            "data" => $data
        ], 201);
    }
}
