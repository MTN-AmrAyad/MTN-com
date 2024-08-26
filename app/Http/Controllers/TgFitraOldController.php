<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TgFitraOldController extends Controller
{
    // function to get all data from the database
    public  function  index(){
        $data = DB::table('tg_fitra')->get();
        return response()->json([
            "message"=>"data retrieved successfully",
            "data"=>$data
        ],201);
    }

    public function store(Request $request){
        // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "name" => "required",
            "country" => "required",
            "phone" => "required",
            "email" => "required",
        ])->stopOnFirstFailure();
        //check the Validation if failed
        if ($valdiator->fails()) {
            //get the first error message
            $firstError = $valdiator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        $data = DB::table('tg_fitra')->create([
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "country" => $request->country,
        ]);
        return response()->json([
            "message" => "data created successfully",
            'data' => $data
        ],201);
    }
}
