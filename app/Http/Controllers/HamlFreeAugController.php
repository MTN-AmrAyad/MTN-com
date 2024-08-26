<?php

namespace App\Http\Controllers;

use App\Models\HamlFreeAug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HamlFreeAugController extends Controller
{
    // function to retrive all date
    public function index()
    {
        $data = HamlFreeAug::all();
        return response()->json([
            "message" => "date retrieved successfully",
            "data" => $data
        ], 201);
    }

    // function to store date
    // public function store(Request $request)
    // {
    //     // make the validation of request
    //     $valdiator = Validator::make($request->all(), [
    //         "client_name" => "required",
    //         "client_country" => "required",
    //         "client_country_code" => "required",
    //         "client_phone" => "required",
    //         "areYouSubscribed" => "required",
    //         "fromWhereDoYouKnowAhmedElDemelawy" => "required",
    //     ])->stopOnFirstFailure();
    //     //check the Validation if failed
    //     if ($valdiator->fails()) {
    //         //get the first error message
    //         $firstError = $valdiator->errors()->first();
    //         return response()->json(['error' => $firstError], 422);
    //     }
    //     //inserting data into the database
    //     $clientInfo = HamlFreeAug::create($request->all());
    //     // return the respon to get the id of the client
    //     return response()->json([
    //         "message" => "data inserted successfully",
    //         "clientInfo" => $clientInfo
    //     ], 201);
    // }

    public function store(Request $request)
    {
        // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "client_name" => "required",
            "client_country" => "required",
            "client_country_code" => "required",
            "client_phone" => "required",
            "areYouSubscribed" => "required",
            "fromWhereDoYouKnowAhmedElDemelawy" => "required",
            "section_sets" => "required",
            "chair_number" => "required",
        ])->stopOnFirstFailure();
        //check the Validation if failed
        if ($valdiator->fails()) {
            //get the first error message
            $firstError = $valdiator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }
        $phone = $request->client_country_code . $request->client_phone;
        $client_name = $request->client_name;

        $checkSet = HamlFreeAug::where('section_sets', $request->section_sets)
            ->where('chair_number', $request->chair_number)->first();
        if ($checkSet) {
            return response()->json('this set is already reversed');
        }

        $dataReg = HamlFreeAug::create($request->all());
        if (!$dataReg) {
            return response()->json([
                "error" => "error",
            ]);
        }
    }

    public function checkChair()
    {
        // Fetch all chair numbers and section sets from the FeelingMedcineAttend table
        $data = HamlFreeAug::all(['chair_number', 'section_sets']);
        $dataCount = $data->count();
        // return response()->json($dataCount);

        // Initialize arrays for sections
        $sections = [
            'section1' => [],
            'section2' => [],
            'section3' => [],
            'section4' => []
        ];

        // Iterate through the data and categorize into sections based on section_sets
        foreach ($data as $record) {
            $chairNumber = $record->chair_number;
            $sectionSet = $record->section_sets;

            // Categorize chair number based on section_sets value
            switch ($sectionSet) {
                case 'section1':
                    $sections['section1'][] = $chairNumber;
                    break;
                case 'section2':
                    $sections['section2'][] = $chairNumber;
                    break;
                case 'section3':
                    $sections['section3'][] = $chairNumber;
                    break;
                case 'section4':
                    $sections['section4'][] = $chairNumber;
                    break;
            }
        }

        // Return the response
        return response()->json([
            'sections' => $sections,
            'reservedCount' => $dataCount
        ], 200);
    }
}
