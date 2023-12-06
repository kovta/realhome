<?php

namespace App\Http\Controllers;

use App\Models\LocationArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nexmo\Call\Collection;
use phpDocumentor\Reflection\Location;

class LocationAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locationAreas = LocationArea::all();
        return view('LocationArea.location-area-list', ['records' => $locationAreas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new LocationArea();
        return view('LocationArea.location-area-create', ['record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(LocationArea::validationRules());
        $entity = new LocationArea();
        $entity->name = $request->name;
        $entity->save();
        return redirect(route('locationAreas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationArea  $locationArea
     * @return \Illuminate\Http\Response
     */
    public function show(LocationArea $locationArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationArea  $locationArea
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationArea $locationArea)
    {
        return view('LocationArea.location-area-edit', ['record' => $locationArea]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationArea  $locationArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationArea $locationArea)
    {
        $request->validate(LocationArea::validationRules());
        $locationArea->name = $request->name;
        $locationArea->save();
        return redirect(route('locationAreas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationArea $locationArea
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(LocationArea $locationArea)
    {
        $locationArea->delete();
        return redirect(route('locationAreas.index'));
    }
}
