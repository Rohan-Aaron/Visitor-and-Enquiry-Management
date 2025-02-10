<?php

namespace App\Http\Controllers;
use DB;
use App\Models\VisitorCategory;
use Illuminate\Http\Request;

class VisitorCategoryController extends Controller
{
    /**
     * Display a listing of visitor categories.
     */
    public function index()
    {
        $categories = VisitorCategory::all();
        return view('category.VisitorCategory', compact('categories'));
    }

    /**
     * Show the form for creating a new visitor category.
     */
    public function create()
    {
        return view('category.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'Category' => 'required|string|max:255|unique:visitorcategory,Category',
        ]);

        VisitorCategory::create(['Category' => $request->Category]);

        return redirect()->route('category.VisitorCategory')->with('success', 'Visitor category added successfully.');
    }

    public function edit($id)
    {
        $category = VisitorCategory::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'Category' => 'required|string|max:255|unique:visitorcategory,Category,' . $id,
        ]);

        $category = VisitorCategory::findOrFail($id);
        $category->update(['Category' => $request->Category]);

        return redirect()->route('category.VisitorCategory')->with('success', 'Visitor category updated successfully.');
    }

    public function destroy($id)
    {
        $category = VisitorCategory::findOrFail($id);
        $category->delete();

    return redirect()->route('category.VisitorCategory')->with('success', 'Visitor category deleted successfully.');
    }
}
