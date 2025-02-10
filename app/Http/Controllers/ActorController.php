<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Country;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Actors = Actor::OrderBy("ActorName","ASC")->paginate(10);
        return view("admin.actors.index",compact("Actors"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Countries = Country::all();
        return view("admin.actors.create",compact("Countries"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validateActor = $request->validate([
            'ActorName' => 'required',
            'ActorNationality' => 'required',
            'ActorDate'=>'required',
            'ActorAvatar' => 'required'
        ]);
        Actor::create($validateActor);
        return redirect()->route("admin.actor.index");
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
        $Countries = Country::all();
        $Actor = Actor::find($id);
        return view("admin.actors.edit",compact("Actor","Countries"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // dd($request->all());
            $validateActor = $request->validate([
                'ActorName' => 'required',
                'ActorNationality' => 'required',
                'ActorDate'=>'required',
                'ActorAvatar' => 'required'
            ]);
            $movie = Actor::find($id);
            $movie->update($validateActor);
            return redirect()->route("admin.actor.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actor = Actor::find($id);
        if($actor){
            $actor->ActorMovie()->detach();
        }
        $actor->delete();
        return redirect()->route("admin.actor.index");
    }
}
