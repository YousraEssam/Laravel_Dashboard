<?php

namespace App\Http\Controllers;

use App\City;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(City::with('country')->get());
        $cities = City::with('country')->get();
        return view('cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = DB::table('countries')->pluck('name','id')->all();
        return view('cities.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150|string',
            'country_id' => 'required',
        ]);
  
        City::create($request->all());
   
        return redirect()->route('cities.index')
                        ->with('success','City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('cities.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = DB::table('countries')->pluck('name','id')->all();
        return view('cities.edit',compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|max:150|string',
            'country_id' => 'required',
        ]);
  
        $city->update($request->all());
   
        return redirect()->route('cities.index')
                        ->with('success','City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
  
        return redirect()->route('cities.index')
                        ->with('success','City deleted successfully');
    }
}
