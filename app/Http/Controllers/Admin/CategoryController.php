<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories
        $categories = DB::table('categories')->get();
        return view('admin/category', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category' => 'required|string|max:255',
        ]);
       
        $category = $request->input('category');

        DB::table('categories')->insert([
            'category_name' => $category,
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $categoryId = $request->input('category_id');
        $categoryName = $request->input('category_name');
    
        DB::table('categories')
            ->where('id', $categoryId)
            ->update(['category_name' => $categoryName, 'updated_at' => now()]);
    
        return redirect()->back()->with('updated', 'Category updated successfully!');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Validate the request to ensure 'selected_ids' is provided
        $request->validate([
            'selected_ids' => 'required|string',
        ]);

        // Get the comma-separated string of IDs and convert it to an array
        $selectedIds = explode(', ', $request->input('selected_ids'));

        // Delete the categories with the selected IDs
        DB::table('categories')->whereIn('id', $selectedIds)->delete();

        // Redirect back with a success message
        return redirect()->back()->with('deleted', 'Selected categories deleted successfully!');
    }

}
