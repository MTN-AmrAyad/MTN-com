<?php

namespace App\Http\Controllers\Survay;

use App\Http\Controllers\Controller;
use App\Models\Survay\RagelFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Survay\Ebt2MainLevelPartTwo;
use App\Models\Survay\Ebt1;

class RagelFeedController extends Controller
{
    public function surveyRagel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phoneNumber' => 'required|string|unique:ragel_feeds,phoneNumber',
            'country_code' => 'required|string',
            'complaints' => 'required|string',
            'developmentFeelings' => 'string',
            'emotionalDevelopment' => 'required|string',
            'expectationsMet' => 'required|string',
            'financialDevelopment' => 'required|string',
            'opinion' => 'required|string',
            'recommendation' => 'required|string',
            'relationshipDevelopment' => 'required|string',
            'suggestions' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = RagelFeed::create($request->all());
        return response()->json($data);
    }
    public function getsurveyRagel()
    {
        $data = RagelFeed::all();
        return response()->json($data);
    }
    
    //  //survey for seconde 5 days
    // public function surveyEBT2PartTwo(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'phoneNumber' => 'required|string|unique:ebt2_main_level_part_twos,phoneNumber',
    //         'country_code' => 'required|string',
    //         'attention' => 'required|string',
    //         'curruntCode' => 'required|string',
    //         'codeAndSign' => 'required|string',
    //         'detectSetuation' => 'required|string',
    //         'codeImage' => 'required|string',
    //         'codeYourLive' => 'required|string',
    //         'selfFeeling' => 'required|string',
    //         'trainning' => 'required|string',
    //         'Suggestion' => 'nullable|string',
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }
    //     $data = Ebt2MainLevelPartTwo::create($request->all());
    //     return response()->json($data);
    // }
    // // get all servey part Two ebt2
    // public function getsurveyEBT2PartTwo()
    // {
    //     $data = Ebt2MainLevelPartTwo::all();
    //     return response()->json($data);
    // }
    
    // //survey for EBT1
    // public function surveyEBT1One(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'phoneNumber' => 'required|string|unique:ebt1s,phoneNumber',
    //         'country_code' => 'required|string',
    //         'detectRelation' => 'required|string',
    //         'forgetFeeling' => 'required|string',
    //         'knowFeeling' => 'required|string',
    //         'feeling-body' => 'required|string',
    //         'feeling' => 'required|string',
    //         'reciveThings' => 'required|string',
    //         'situation-ideas' => 'required|string',
    //         'secChange' => 'required|string',
    //         'diffFeeling' => 'required|string',
    //         'threeAxies' => 'required|string',
    //         'knowImage' => 'required|string',
    //         'balanceFeeling' => 'required|string',
    //         'suggestion' => 'nullable|string',
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }
    //     $data = Ebt1::create($request->all());
    //     return response()->json($data);
    // }
    // // get all servey For EBT1
    // public function getsurveyEBT1One()
    // {
    //     $data = Ebt1::all();
    //     return response()->json($data);
    // }
}
