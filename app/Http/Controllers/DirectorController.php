<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;
use App\Models\Country;


class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Directors = Director::Orderby("created_at","DESC")->paginate(10);
        return view("admin.directors.index",compact("Directors"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Countries = Country::all();
        return view("admin.directors.create", compact("Countries"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateDirectors = $request->validate([
            'DirectorName' =>'required',
            'DirectorNationality' =>'required',
            'DirectorDate' =>'required',
            'DirectorAvatar' =>'required',
        ]);
        Director::Create($validateDirectors);
        return redirect()->route("admin.director.index")    ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Director = Director::find($id);
        $Countries = Country::all();
        return view("admin.directors.edit",compact("Director","Countries"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateDirectors = $request->validate([
            'DirectorName' =>'required',
            'DirectorNationality' =>'required',
            'DirectorDate' =>'required',
            'DirectorAvatar' =>'required',
        ]);
        $Director = Director::find($id);
        $Director->update($validateDirectors);
        return redirect()->route("admin.director.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $director = Director::find($id);
        if($director){
            $director->DirectorMovie()->detach();
        }
        $director->delete();
        return redirect()->route("admin.director.index");
    }
}
