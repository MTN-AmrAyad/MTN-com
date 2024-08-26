<?php

namespace App\Http\Controllers;

use App\Models\EbmExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EbmExamController extends Controller
{
    //function to store the info of each user
    public function usersInfo(Request $request)
    {
        // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "client_name" => "required",
            "client_email" => "required",
            "client_country" => "required",
            "client_country_code" => "required",
            "client_phone" => "required",
        ])->stopOnFirstFailure();
        //check the Validation if failed
        if ($valdiator->fails()) {
            //get the first error message
            $firstError = $valdiator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        //inserting data into the database
        $clientInfo = EbmExam::create($request->all());
        // return the respon to get the id of the client
        return response()->json([
            "message" => "data inserted successfully",
            "clientInfo" => $clientInfo
        ], 201);
    }

    //function to update the answers and score of the exam
    public function updateExam(Request $request)
    {
        // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "answers" => "required",
            "client_score" => "required",
        ])->stopOnFirstFailure();
        //check the Validation if failed
        if ($valdiator->fails()) {
            //get the first error message
            $firstError = $valdiator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        // check if client info is already exist or not
        $clientRecord = EbmExam::find($request->id);
        if (!$clientRecord) {
            return response()->json([
                "message" => "client record not found",
            ]);
        }
        //update the answer of the client record
        $clientRecord->update($request->all());
        $clientRecord->save();
        return response()->json([
            "message" => "client answer was updated successfully",
            "clientRecord" => $clientRecord
        ], 201);
    }

    //function to get all data for exam
    public function getAll()
    {
        // get data query
        $clients = EbmExam::all();
        return response()->json([
            "message" => "data retrieved successfully",
            "clients" => $clients
        ], 201);
    }
    
    // function get each client by id
    public function getClientById($id)
    {
        //check if client id exists
        $checkId = EbmExam::find($id);
        if (!$checkId) {
            return response()->json([
                "message" => "client id not found",
            ], 422);
        }
        //rertrived client by id
        $client = EbmExam::where('id', $id)->get();
        return response()->json([
            "message" => "client data was retrieved successfully",
            "client" => $client
        ], 201);
    }
}
