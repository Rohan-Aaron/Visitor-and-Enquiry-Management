<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Enquiries;
use App\Models\Program;
use RealRashid\SweetAlert\Facades\Alert;

class EnquiryController extends Controller
{



    public function home()
    {

        $programs = Program::active()->get();



        return view('welcome', compact('programs'));
    }

    public function fetchCountries()
    {

        $countries = config('places.countries');
        return response()->json(['countries' => $countries]);
    }
    public function fetchStates() {
        $states = config('places.states');
        return response()->json(['states' => $states]);
    }
    public function fetchCourses()
    {
        $program_id = request()->get('program_id');
        $validator = Validator::make(['program_id'  => $program_id], [
            'program_id' => 'required|numeric|exists:programs,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid Program']);
        }
        $courses = Course::where('program_id', $program_id)->get();

        return response()->json(['courses' => $courses]);
    }

    public function index(Request $request)
    {
        // Start the query
        $enquiries = Enquiries::query();

        // Apply the search condition if a search term is present
        if ($request->has('search')) {
            $search = $request->input('search');

            $enquiries->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Paginate the results (10 per page)
        $enquiries = $enquiries->paginate(10);

        // Return the view with the enquiries
        return view('enquiry.index', compact('enquiries'));
    }


    public function  show($id)
    {
        $enquiry = Enquiries::findOrFail($id);
        return view('enquiry.show', compact('enquiry'));
    }

    public function submitform(Request $request)
    {

        // Validate the incoming data
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'gender'    => 'required|string|in:male,female,other',
            'phone'     => 'required|numeric|digits_between:7,15',
            'country' => 'required||string',
            'state' => 'nullable|string',
            'isnri'     => 'required',
            'program' => 'required',
            'course' => 'required',
            'agreement' => 'required|in:1',
        ]);
        if ($validatedData->fails()) {
            toastr()->error($validatedData->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validatedData->errors())
                ->withInput();
        };
        Enquiries::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'is_nri' => $request->isnri,
            'program' => $request->program,
            'course' => $request->course,
        ]);
        return redirect()->back()->with('success', 'Your data has been saved successfully!');
    }
}
