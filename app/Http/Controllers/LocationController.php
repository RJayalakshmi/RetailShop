<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Validator;
use Route;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin/locations')->with(compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'name'=> 'required|max:255|unique:locations'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $location = $request->all();

            $location = Location::create($location);

            return response()->json(['message'=> 'Location has been created successfully','data' => $location, 'status' => 'Success'], 200);;


        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->toArray(), [
            'name'=> ['required','max:255',Rule::unique('locations')->ignore($location->id)]
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $location->name = $request->name;

            $location->save();

            return response()->json(['message'=> 'Location has been updated successfully','data' => $location, 'status' => 'Success'], 200);;


        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        try{
            // Delete products of product type
            $location->products()->delete();
            $location->users()->delete();
            $location->delete();

            return response()->json(['message'=> 'Location has been deleted successfully', 'status' => 'Success'], 200);;

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }
}
