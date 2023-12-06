<?php

namespace App\Http\Controllers;

use App\Models\AdvertisingPartner;
use Illuminate\Http\Request;

class AdvertisingPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = AdvertisingPartner::all();
        return view('AdvertisingPartner.advertisingpartner-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new AdvertisingPartner();
        return view('AdvertisingPartner.advertisingpartner-create', ['record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(AdvertisingPartner::validationRules());

        $entity = new AdvertisingPartner();
        $entity->name = $request->name;
        $entity->save();
        return redirect(route('advertisingPartners.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvertisingPartner  $advertisingPartner
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertisingPartner $advertisingPartner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvertisingPartner  $advertisingPartner
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertisingPartner $advertisingPartner)
    {
        return view('AdvertisingPartner.advertisingpartner-edit', ['record' => $advertisingPartner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvertisingPartner  $advertisingPartner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvertisingPartner $advertisingPartner)
    {
        $request->validate(AdvertisingPartner::validationRules());

        $advertisingPartner->name = $request->name;
        $advertisingPartner->save();
        return redirect(route('advertisingPartners.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvertisingPartner $advertisingPartner
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AdvertisingPartner $advertisingPartner)
    {
        $advertisingPartner->delete();
        return redirect(route('advertisingPartners.index'));
    }
}
