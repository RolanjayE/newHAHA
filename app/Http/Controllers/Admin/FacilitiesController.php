<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryIds = DB::table('categories')->pluck('category_name', 'id');
    
        $facilities = DB::table('facilities')
            ->leftJoin('facilities_images', 'facilities.id', '=', 'facilities_images.facility_id')
            ->select('facilities.*', DB::raw('GROUP_CONCAT(facilities_images.image_name) as images'))
            ->groupBy('facilities.id', 'facilities.category_id', 'facilities.facility_name', 'facilities.price', 'facilities.discount', 'facilities.total_price', 'facilities.amenities', 'facilities.created_at', 'facilities.updated_at')
            ->get();
    
        $facilities = $facilities->map(function($facility) {
            $facility->images = $facility->images ? explode(',', $facility->images) : [];
            return $facility;
        });
    
        // dd($facilities);
    
        return view('admin.facilities', ['categoryIds' => $categoryIds, 'facilities' => $facilities]);
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
          // Calculate the total price
        $price = $request->input('price');
        $discount = $request->input('discount');
        $totalPrice = $price - ($price * ($discount / 100)); 

        // Insert data into the facilities table
        $facilityId = DB::table('facilities')->insertGetId([
            'category_id' => $request->input('category'),
            'facility_name' => $request->input('facility_name'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'total_price' => $totalPrice,
            'amenities' => $request->input('amenities'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert data into the facilities_images table
        foreach ($request->file('images') as $image) {
            $imageName = $image->getClientOriginalName();

            // Assuming you want to store images in the public/images directory
            $image->move(public_path('images'), $imageName); 

            DB::table('facilities_images')->insert([
                'facility_id' => $facilityId,
                'image_name' => $imageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Facility and images added successfully!');
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
        $categoryIds = DB::table('categories')->pluck('category_name', 'id');
    
        $facilities = DB::table('facilities')
        ->leftJoin('facilities_images', 'facilities.id', '=', 'facilities_images.facility_id')
        ->select('facilities.*', DB::raw('GROUP_CONCAT(facilities_images.image_name) as images'))
        ->where('facilities.id', '=', $id) // Filter for facilities with id = 10
        ->groupBy('facilities.id', 'facilities.category_id', 'facilities.facility_name', 'facilities.price', 'facilities.discount', 'facilities.total_price', 'facilities.amenities', 'facilities.created_at', 'facilities.updated_at')
        ->get();

        $facilities = $facilities->map(function($facility) {
            $facility->images = $facility->images ? explode(',', $facility->images) : [];
            return $facility;
        });

        // dd($facilities);

        return view('admin.facilities-update', ['categoryIds' => $categoryIds, 'facilities' => $facilities]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Extract the data from the request
    $facilityId = $request->input('facility_id');
    $categoryId = $request->input('category');
    $facilityName = $request->input('facility_name');
    $price = $request->input('price');
    $amenities = $request->input('amenities');
    $images = $request->file('images'); // This will be an array of UploadedFile objects

    // Calculate the total price considering the discount
    $discount = $request->input('discount', 0);
    $totalPrice = $price - ($price * ($discount / 100));

    // Update the facility in the database using the DB class
    DB::table('facilities')
        ->where('id', $id)
        ->update([
            'category_id' => $categoryId,
            'facility_name' => $facilityName,
            'price' => $price,
            'discount' => $discount,
            'total_price' => $totalPrice, // Ensure the discounted price is stored correctly
            'amenities' => $amenities,
            'updated_at' => now(),
        ]);

    if ($images) {
        // Fetch previous images from the database
        $previousImages = DB::table('facilities_images')
            ->where('facility_id', $facilityId)
            ->get();

        // Delete the previous images from storage
        foreach ($previousImages as $prevImage) {
            Storage::disk('public')->delete('images/' . $prevImage->image_name);
        }

        // Delete the previous image records from the database
        DB::table('facilities_images')
            ->where('facility_id', $facilityId)
            ->delete();

        // Insert new images
        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Insert the image path in the database
            DB::table('facilities_images')->insert([
                'facility_id' => $facilityId,
                'image_name' => $imageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Redirect back with success message or to a different page
    return redirect()->back()->with('success', 'Facility and images updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
