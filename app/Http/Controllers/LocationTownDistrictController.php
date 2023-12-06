<?php

namespace App\Http\Controllers;

use App\Models\LocationArea;
use App\Models\LocationTownDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationTownDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = LocationTownDistrict::all();
        return view('LocationTownDistrict.location-town-district-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new LocationTownDistrict();
        $areas = LocationArea::toSelectValueSet(LocationArea::all(), $entity->location_area_id);
        return view('LocationTownDistrict.location-town-district-create', ['areas' => $areas, 'record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(LocationTownDistrict::validationRules());

        $entity = new LocationTownDistrict();
        $entity->name = $request->name;
        $entity->location_area_id = $request->location_area_id;
        $entity->save();
        return redirect(route('locationTownDistricts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationTownDistrict  $locationTownDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(LocationTownDistrict $locationTownDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationTownDistrict  $locationTownDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationTownDistrict $locationTownDistrict)
    {
        $areas = LocationArea::toSelectValueSet(LocationArea::all(), $locationTownDistrict->location_area_id);
        return view('LocationTownDistrict.location-town-district-edit', ['areas' => $areas, 'record' => $locationTownDistrict]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationTownDistrict  $locationTownDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationTownDistrict $locationTownDistrict)
    {
        $request->validate(LocationTownDistrict::validationRules());

        $locationTownDistrict->name = $request->name;
        $locationTownDistrict->location_area_id = $request->location_area_id;
        $locationTownDistrict->save();
        return redirect(route('locationTownDistricts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationTownDistrict $locationTownDistrict
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(LocationTownDistrict $locationTownDistrict)
    {
        $locationTownDistrict->delete();
        return redirect(route('locationTownDistricts.index'));
    }
}
