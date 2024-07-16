<?php

namespace App\Http\Controllers;

use App\Models\Luscherpackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


class LuscherpackageController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        $validatedData = Validator::make($request->all(), [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'code' => 'required|string',
            'phoneNumber' => 'required|string',
            'address' => 'required|string',
            'zone' => 'required|string',
            'buildingNumber' => 'required',
            'floorNumber' => 'required',
            'postalCode' => 'required',
            
        ]);
        if ($validatedData->fails()) {

            return response()->json([
                'message' => 'You already Registered',


            ], 501);
        } else {
            $registraions = Luscherpackage::create($request->all());
            return response()->json([
                'message' => 'Regstration successfully',
                'data' => $registraions,
            ], 200);
        }
    }

    public function review()
    {
        $data = Luscherpackage::all();
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $data,
        ], 201);
    }
}
