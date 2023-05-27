<?php

namespace App\Http\Controllers;

use App\Models\PodcastCategory;
use Illuminate\Http\Request;

class PodcastCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Request $request)
    {
        $name = $request->input('name');
        $category = PodcastCategory::where('name', $name)->first();

        return view('welcome', [        // change view when created
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PodcastCategory $podcastCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PodcastCategory $podcastCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PodcastCategory $podcastCategory)
    {
        //
    }
}
