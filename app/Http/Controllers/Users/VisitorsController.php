<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VisitorsController extends Controller
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

       

        return view('user.shop',  ['categoryIds' => $categoryIds, 'facilities' => $facilities]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

       
        return view("user.itemView", ['categoryIds' => $categoryIds, 'facilities' => $facilities]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
