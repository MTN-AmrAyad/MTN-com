<?php

namespace App\Http\Controllers;

use App\Models\CtrlAttendJuly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CtrlAttendJulyController extends Controller
{
    public function index()
    {
        $data = CtrlAttendJuly::get();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|string|email|max:255|unique:clients',
            'client_country' => 'required|string|max:255',
            'client_country_code' => 'required|string|max:5',
            'client_phone' => 'required|string|max:20',
            'attendance' => 'nullable|in:live,online,',
            'reservation' => 'required|array',
            'chairNumber' => 'nullable|integer',
            'section' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $client = CtrlAttendJuly::create($request->all());

        return response()->json([
            'message' => 'Client created successfully',
            'client' => $client
        ], 201);
    }

    public function checkChair()
    {
        // Fetch all chair numbers and section sets from the FeelingMedcineAttend table
        $data = CtrlAttendJuly::all(['chairNumber', 'section']);
        $dataCount = $data->count();
        // return response()->json($dataCount);

        // Initialize arrays for sections
        $sections = [
            'section1' => [],
            'section2' => [],
            'section3' => [],
            // 'section4' => []
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
                    // case 'section4':
                    //     $sections['section4'][] = $chairNumber;
                    //     break;
            }
        }

        // Return the response
        return response()->json([
            'sections' => $sections,
            'reservedCount' => $dataCount
        ], 200);
    }
}
