<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Visitors;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{

    public function index(Request $request)  {
        $visitors = DB::table('visitors')
        ->leftJoin('visits', 'visitors.visitor_id', '=', 'visits.visitor_id')
        ->select(
            'visitors.visitor_id',
            'visitors.name',
            'visitors.email',
            'visitors.phone',
            DB::raw('COUNT(visits.visitor_id) as visit_count')
        )
        ->groupBy('visitors.visitor_id', 'visitors.name', 'visitors.email', 'visitors.phone');
 

        if ($request->has('search')) {
            $search = $request->input('search');
    
            // Apply the search query conditions before executing the query
            $visitors->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%")
                      ->orWhere('visitors.visitor_id', 'LIKE', "%{$search}%");
            });
        
        }
        // Filter by date range with time
        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = $request->input('from_date') . ' 00:00:00'; // Start from 00:00:00
            $toDate = $request->input('to_date') . ' 23:59:59'; // End at 23:59:59

            $visitors->whereBetween('arrived_at', [$fromDate, $toDate]);
        } elseif ($request->has('from_date')) {
            $fromDate = $request->input('from_date') . ' 00:00:00'; // Start from 00:00:00
            $visitors->where('arrived_at', '>=', $fromDate);
        } elseif ($request->has('to_date')) {
            $toDate = $request->input('to_date') . ' 23:59:59'; // End at 23:59:59
            $visitors->where('arrived_at', '<=', $toDate);
        }
        $visitors = $visitors->paginate(10);
        return view('auth.visitors',compact('visitors'));
    }

    public function show($id){
        $visitor=DB::table('visitors')
        ->where('visitor_id',$id)
        ->select('name','email','phone','created_at')
        ->get();
        $queries = DB::table('visitors')
        ->join('visits', 'visitors.visitor_id', '=', 'visits.visitor_id')
        ->where('visitors.visitor_id', $id)  // Ensure it fetches data for the selected visitor
        ->select(
            'visits.category',
            'visits.other_category',
            'visits.arrived_at',
            'visits.description'
        )->paginate(10);
        return view('visitors.show', compact('queries','visitor'));
    }

    public function store(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'category' => 'required|string|max:255',
        'visit_date' => 'required|date',
        'description' => 'nullable|string',
    ]);

    // Start a transaction to ensure data consistency
    DB::beginTransaction();

    try {
        // Insert visitor details into 'visitors' table and get the inserted ID
        $visitor_id = DB::table('visitors')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert visit details into 'visits' table using the retrieved visitor_id
        DB::table('visits')->insert([
            'visitor_id' => $visitor_id, // Fetch the generated visitor_id
            'category' => $request->category,
            'other_category' => $request->other_category ?? null,
            'arrived_at' => $request->visit_date,
            'description' => $request->description ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Commit the transaction
        DB::commit();

        // Redirect with success message
        return redirect()->route('visitors.index')->with('success', 'Visitor and visit record added successfully.');
    } catch (\Exception $e) {
        // Rollback in case of any error
        DB::rollBack();
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

}
