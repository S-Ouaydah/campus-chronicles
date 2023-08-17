<?php

namespace App\Http\Controllers;

use App\Models\PodcastCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
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
        return view('', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        // $currentuser = Auth::user();

        $formData = new PodcastCategory();
        $formData->name = $validatedData['name'];
        $formData->podcast_count = 0;

        if ($formData->save()) {
            return redirect('/admindashboard')->with('success', 'Form submitted successfully!');
        }
        return redirect('/admindashboard')->with('error', 'an error has occured!');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = PodcastCategory::all();
        $users = User::where('isAdmin', false)->get();
        return view('admindashboard', [
           'categories' => $categories,
           'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_category(PodcastCategory $category)
    {
        $category->delete();
        
        return Redirect::route('admindashboard')->with('success', 'Deleted successfully!');
    }

    public function destroy_user(User $user)
    {
        $user->delete();
        
        return Redirect::route('admindashboard')->with('success', 'Deleted successfully!');
    }

}
