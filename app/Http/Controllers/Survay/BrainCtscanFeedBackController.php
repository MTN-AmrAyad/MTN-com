<?php

namespace App\Http\Controllers\Survay;

use App\Http\Controllers\Controller;
use App\Models\Survay\BrainCtscanFeedBack;
use Illuminate\Http\Request;

class BrainCtscanFeedBackController extends Controller
{
    //
    // Index method to list all feedback
    public function index()
    {
        // Retrieve all feedback records
        $feedbacks = BrainCtscanFeedBack::all();

        // Return the feedback records as JSON
        return response()->json($feedbacks, 200);
    }
    // Store method to save new feedback
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_code' => 'required|string|max:10',
            'phoneNumber' => 'required|string|max:20',
            'q1' => 'required|string|max:255',
            'q2' => 'required|string|max:255',
            'q3' => 'required|string|max:255',
            'q4' => 'required|string|max:255',
            'q5' => 'required|string|max:255',
            'q6' => 'required|string|max:255',
            'q7' => 'required|string|max:255',
            'q8' => 'required|string|max:255',
            'q9' => 'required|string|max:255',
            'q10' => 'required|string|max:255',
            'q11' => 'required|string|max:255',
            'q12' => 'required|string|max:255',
            'q13' => 'required|string|max:255',
            'q14' => 'nullable|string|max:255',
            'q15' => 'nullable|string|max:255',
        ]);

        // Create a new feedback record
        $feedback = BrainCtscanFeedBack::create($validatedData);

        // Return the created feedback as JSON
        return response()->json($feedback, 201);
    }
}
