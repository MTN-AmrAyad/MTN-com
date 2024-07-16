<?php

namespace App\Http\Controllers;

use App\Models\AdamAndEve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdamEveTrainingEvaluation;

use Illuminate\Support\Facades\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class AdamAndEveController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_name" => "required|string",
            "client_email" => "required|email|unique:adam_and_eves,client_email",
            "client_country" => "required|string",
            "client_country_code" => "required|string",
            "client_phone" => "required|string|unique:adam_and_eves,client_phone",

        ])->stopOnFirstFailure();;

        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        $regstration = AdamAndEve::create($request->all());
        if(!$regstration){
                return response()->json([
                'message' => 'Error in Query ',
            ], 403);
            }else{
            // after create the lead from landpage login to ERP to get credintials
            AdamAndEveController::ERPLogin($request);
            }
        return response()->json([
            "status" => true,
            "message" => "created successfully"
        ], 201);
    }
    public function review()
    {
        $data = AdamAndEve::all();
        return response()->json([
            "status" => true,
            "message" => "data retrieved successfully",
            "data" => $data
        ]);
    }
    
     // login to ERP and insert lead from form to ERP Lead
    public function ERPLogin(Request $request)
    {
        $finalphone = $request->client_country_code . $request->client_phone;
        $response = Http::withHeaders([
            'Authorization' => 'Basic NWE4ZjBhODU3YjIyYWJmOmUxOWU3OGMxMjQ2MDY0OQ==',
        ])->post('https://mtn.smartsoleg.com/api/resource/Lead', [
            "project" => "adam_and_eve_Landpage",
            "lead_name" => $request->client_name,
            "lead_country" => $request->client_country,
            "phone" => $finalphone,
            "email_id" => $request->client_email,

        ]);
    }
    
     //public function create AdamEveTrainingEvaluation
    public function createTrainingEvaluation(Request $request)
    {
        // Validation rules for the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phoneNumber' => 'required|string|unique:adam_eve_training_evaluation,phoneNumber',
            'meetExpectations' => 'required',
            'applyLearned' => 'required',
            'trainingObjectives' => 'required',
            'isContentOrganized' => 'required',
            'trainerWasKnowledgeable' => 'required',
            'qualityOfInstruction' => 'required',
            'trainerMetTheObjectives' => 'required',
            'participationWasEncouraged' => 'required',
            'AdequateTimeWasProvided' => 'required',
            'MeetingRoomRate' => 'required',
            'InterpretationRate' => 'required',
            'trainingOverallRate' => 'required',
            'WhatIsMostBenefits' => 'nullable',
            'WhatIsAspectOfTrainingCouldBeImproved' => 'nullable',
            'DescribeYourExperience' => 'nullable',
            'OtherComments' => 'nullable',
            'DoYouRecommendSomeOne' => 'required',
            'RecommendedPersonName' => 'nullable',
            'RecommendedPersonPhone' => 'nullable',
            'country_code' => 'nullable',
            'RecommendedPersonCountryCode' => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Create the training evaluation record
        $data = AdamEveTrainingEvaluation::create($request->all());

        // Return success response with the created data
        return response()->json(['data' => $data], 201); // 201 Created status code
    }
    //public function read the training evaluation record
    public function readTrainingEvaluation()
    {
        $data = AdamEveTrainingEvaluation::all();
        return response()->json($data);
    }
}
