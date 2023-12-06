<?php

namespace App\Http\Controllers;

use App\Models\LocationNeighborhood;
use App\Models\LocationTownDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationNeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = LocationNeighborhood::all();
        return view('LocationNeighborhood.location-neighborhood-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new LocationNeighborhood();
        $districts = LocationTownDistrict::toSelectValueSet(LocationTownDistrict::all(), $entity->location_town_district_id);
        return view('LocationNeighborhood.location-neighborhood-create', ['districts' => $districts, 'record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(LocationNeighborhood::validationRules());

        $entity = new LocationNeighborhood();
        $entity->name = $request->name;
        $entity->location_town_district_id = $request->location_town_district_id;
        $entity->save();
        return redirect(route('locationNeighborhoods.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationNeighborhood  $locationNeighborhood
     * @return \Illuminate\Http\Response
     */
    public function show(LocationNeighborhood $locationNeighborhood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationNeighborhood  $locationNeighborhood
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationNeighborhood $locationNeighborhood)
    {
        $districts = LocationTownDistrict::toSelectValueSet(LocationTownDistrict::all(), $locationNeighborhood->location_town_district_id);
        return view('LocationNeighborhood.location-neighborhood-edit', ['districts' => $districts, 'record' => $locationNeighborhood]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationNeighborhood  $locationNeighborhood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationNeighborhood $locationNeighborhood)
    {
        $request->validate(LocationNeighborhood::validationRules());

        $locationNeighborhood->name = $request->name;
        $locationNeighborhood->location_town_district_id = $request->location_town_district_id;
        $locationNeighborhood->save();
        return redirect(route('locationNeighborhoods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationNeighborhood $locationNeighborhood
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(LocationNeighborhood $locationNeighborhood)
    {
        $locationNeighborhood->delete();
        return redirect(route('locationNeighborhoods.index'));
    }
}
