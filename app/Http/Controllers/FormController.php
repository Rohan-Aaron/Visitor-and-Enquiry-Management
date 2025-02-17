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
        $categories = VisitorCategory::all();
        return view('visitors.form', compact('categories'));  // Return the form view
    }

    // Handle the form submission
    public function submitForm(Request $request)
    {
        // Validate the incoming data
        $validatedData = Validator::make($request->all(), [
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
        $visitor = Visitors::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'phone' => $request->phoneNumber]
        );

        // Create a new visit record
        $visit = Visits::create([
            'visitor_id' => $visitor->id,
            'category' => $request->reasonForVisit,
            'other_category' => $request->other,
            'description' => $request->description,
            'arrived_at' => now(),
            'exited_at' => null,
        ]);
        // Fetch category name from VisitorCategory table using the provided category ID
        $categoryname = VisitorCategory::find($request->reasonForVisit)->category ?? 'NULL';


        session([
            'visitor' => $visitor,
            'visit' => $visit,
            'categoryname' => $categoryname,
        ]);

        $htmlContent = view('visitors.form_result', compact('visitor', 'visit', 'categoryname'))->render();

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
        $categoryname = session('categoryname');

        // Clear session data after displaying result
        session()->forget(['visitor', 'visit']);

        // Pass data to the result page view
        return view('form_result', compact('visitor', 'visit'));  // Pass 'otherCategory' to view
    }
}
