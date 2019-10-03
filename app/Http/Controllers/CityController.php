<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(City::class, 'citiess');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $cities = City::latest()->with('country');
            
            return DataTables::of($cities)
                ->addIndexColumn()
                ->addColumn('actions', 'cities.buttons')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('cities.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        return view('cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')
            ->with('success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::pluck('name', 'id');
        return view('cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\City                $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('cities.index')
            ->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')
            ->with('success', 'City deleted successfully');
    }

    /**
     * Get List of All Cities related to specific Country
     */
    public function getCityList($id)
    {
        $cities = City::where("country_id", $id)->pluck("name", "id");
        return response()->json($cities);
    }
}
