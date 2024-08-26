<?php

namespace App\Http\Controllers;


use App\Models\HowBuildQr;
use App\Models\HowbuildSickness;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HowbuildSicknessController extends Controller
{
    // function to retrive all date
    public function index()
    {
        $data = HowbuildSickness::all();
        return response()->json([
            "message" => "date retrieved successfully",
            "data" => $data
        ], 201);
    }

    public function store(Request $request)
    {
        // make the validation of request
        $valdiator = Validator::make($request->all(), [
            "client_name" => "required",
            "client_email" => "required|unique:howbuild_sicknesses,client_email",
            "client_job" => "required",
            "client_country" => "required",
            "client_country_code" => "required",
            "client_phone" => "required|unique:howbuild_sicknesses,client_phone",
            'question' => 'required|string|max:1000',
            "attendance" => "required",
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

        $checkSet = HowbuildSickness::where('section_sets', $request->section_sets)
            ->where('chair_number', $request->chair_number)->first();
        if ($checkSet) {
            return response()->json('this set is already reversed');
        }

        $dataReg = HowbuildSickness::create($request->all());
        if (!$dataReg) {
            return response()->json([
                "error" => "error",
            ]);
        }
    }

    public function checkChair()
    {
        // Fetch all chair numbers and section sets from the FeelingMedcineAttend table
        $data = HowbuildSickness::all(['chair_number', 'section_sets']);
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

    public function getClientById($id)
    {
        $client = HowbuildSickness::find($id);
        if (!$client) {
            return response()->json([
                "message" => "something went wrong",

            ]);
        }
        return response()->json([$client]);
    }
    public function scanQr($id, $key)
    {
        $client = HowbuildSickness::find($id);
        if (!$client) {
            return response()->json([
                "error" => "Id client not found"
            ], 400);
        }

        $decodedKey = base64_decode($key);
        // $inputKey = $request->passCode;
        if ($decodedKey === "test") {
            $QrClient = HowBuildQr::create([
                "client_name" => $client->client_name,
                "client_email" => $client->client_email,
                "client_country_code" => $client->client_country_code,
                "client_phone" => $client->client_phone,
            ]);
            return response()->json([
                "message" => "Client Scanned QR Code",
                "client" => $QrClient
            ]);
        }
        return response()->json([
            "error" => "key not valied"
        ], 400);
    }
    public function getQr()
    {
        $data = HowBuildQr::get();
        return response()->json([
            "message" => "data retrived successfully",
            "data" => $data

        ], 201);
    }
}
