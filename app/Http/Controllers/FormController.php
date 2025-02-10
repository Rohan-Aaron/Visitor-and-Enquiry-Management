<?php

namespace App\Http\Controllers;
use App\Mail\VisitorEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Visitors;
use App\Models\Visits;
use App\Models\VisitorCategory;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Show the form page
    public function showForm()
    {
        $categories=VisitorCategory::all();
        return view('visitors.form',compact('categories'));  // Return the form view
    }

    // Handle the form submission
    public function submitForm(Request $request)
    {
        // Validate the incoming data
        $validatedData = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phoneNumber' => 'required|max:15',
            'reasonForVisit' => 'required',
            'description' => 'nullable',
            'other' => 'nullable',  // Optional if "other" is selected
        ]);
        if ($validatedData->fails()) {
            return redirect()
                ->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        // Check if the visitor already exists
        $visitor = Visitors::where('email', $request->email)->first();

        if (!$visitor) {
            // If visitor doesn't exist, create a new visitor and a visit record
            $visitor=Visitors::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phoneNumber,
            ]);
        }
        $visitor = Visitors::where('email', $request->email)->first();

        // Create a new visit record
        $visit = new Visits();
        $visit->visitor_id = $visitor->visitor_id;
        $visit->category = $request->reasonForVisit;
        $visit->other_category = $request->other;  // If 'other' is filled
        $visit->description = $request->description;
        $visit->arrived_at = now();  // Store the current timestamp for arrival
        $visit->exited_at = null;  // Set to null initially
        $visit->save();

        session([
            'visitor'=>$visitor,
            'visit'=>$visit,
        ]);

        $htmlContent = view('visitors.form_result', compact('visitor', 'visit'))->render();

        Mail::to($request->email)->send(new VisitorEmail($htmlContent));


        // Redirect to result page
        return redirect()->route('visitors.result');
    }

    // Show the result page (after form submission)
    public function showResult()
{
    // Check if form data is stored in the session
    if (!session()->has('visitor')) {
        // If no session data, redirect to the form
        return redirect()->route('form.show');
    }

    // Fetch the data from session
    $visitor = session('visitor');
    $visit = session('visit');

    // Clear session data after displaying result
    session()->forget(['visitor', 'visit']);

    // Pass data to the result page view
    return view('form_result', compact('visitor', 'visit'));  // Pass 'otherCategory' to view
}
}
