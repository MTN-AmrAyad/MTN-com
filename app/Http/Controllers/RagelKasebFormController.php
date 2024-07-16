<?php

namespace App\Http\Controllers;

use App\Models\RagelKasebForm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RagelKasebFormController extends Controller
{
     // function for Form in Landpage RagelKasebForm
    public function ragelKasebform(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:ragel_kaseb_forms,email',
            'phone' => 'required|unique:ragel_kaseb_forms,phone',
            'country' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'You Already registered with your phone or email ',
            ], 501);
        } else {
            
            // RagelKasebFormController::sendMessage($request);
            RagelKasebFormController::ERPLogin($request);
            RagelKasebForm::create($request->all());
            return response()->json([
                'message' => 'Regisration Successfully submitted',
            ], 201);
        }
    }
    // Retrive data form RagelKasebForm from database
    public function review()
    {
        $data = RagelKasebForm::all();
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $data
        ], 200);
    }
    
    
    
     // login to ERP and insert lead from form to ERP Lead
    public function ERPLogin(Request $request)
    {
        $finalphone = $request->country_code . $request->phone;
        $response = Http::withHeaders([
            'Authorization' => 'Basic NWE4ZjBhODU3YjIyYWJmOmUxOWU3OGMxMjQ2MDY0OQ==',
        ])->post('https://mtn.smartsoleg.com/api/resource/Lead', [
            "project" => "ragel_kaseb_os_Form",
             "project" => "ebm_landpage",
            "lead_name" => $request->name,
            "lead_country" => "Egypt",
            "phone" => $finalphone,
            "email_id" => $request->email,
            "status" => "Lead",

        ]);
    }
}
