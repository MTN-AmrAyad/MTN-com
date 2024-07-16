<?php

namespace App\Http\Controllers;

use App\Models\CTRL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class CTRLController extends Controller
{
    public function create(Request $request)
    {
         $validation = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:c_t_r_l_s,email",
            "code" => "required|string",
            "phone" => "required|string|unique:c_t_r_l_s,phone",
            "country" => "required|string",
            "question" => "required|string",
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'You are Already Registered',
            ], 501);
        } else {
            $regstration = CTRL::create($request->all());
               if(!$regstration){
                return response()->json([
                'message' => 'Error in Query ',
            ], 403);
            }else{
            // after create the lead from landpage login to ERP to get credintials
            CTRLController::ERPLogin($request);
            }
            
            return response()->json([
                'message' => 'Registration Successfully ',
                'data' => $regstration
            ], 201);
        }
    }

    public function review()
    {
        $data = CTRL::all();
        return response()->json([
            'message' => 'Data Retrieved successfully',
            'data' => $data
        ], 200);
    }
    
     // login to ERP and insert lead from form to ERP Lead
    public function ERPLogin(Request $request)
    {
        $finalphone = $request->code . $request->phone;
        $response = Http::withHeaders([
            'Authorization' => 'Basic NWE4ZjBhODU3YjIyYWJmOmUxOWU3OGMxMjQ2MDY0OQ==',
        ])->post('https://mtn.smartsoleg.com/api/resource/Lead', [
            "project" => "Ctrl_Landpage",
            "lead_name" => $request->name,
            "lead_country" => $request->country,
            "phone" => $finalphone,
            "email_id" => $request->email,

        ]);
    }
}
