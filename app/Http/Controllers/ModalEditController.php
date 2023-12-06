<?php

namespace App\Http\Controllers;

use App\Http\Traits\SupportsInFrameLayout;
use App\Models\AdvertisingPartner;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ModalEditController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = AdvertisingPartner::all();
        return view('prototypes.proto-modaledit-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $entity = new AdvertisingPartner();
        return view('prototypes.proto-modaledit-create', ['record' => $entity]);
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
            'name' => 'required|max:255',
        ]);

        $entity = new AdvertisingPartner();
        $entity->name = $request->name;
        $entity->save();
        return redirect(route('modalEditPrototypes.index') .'?refreshMainFrame=1');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvertisingPartner  $advertisingPartner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, AdvertisingPartner $advertisingPartner)
    {
        return view('prototypes.proto-modaledit-edit', ['record' => $advertisingPartner]);
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $advertisingPartner->name = $request->name;
        $advertisingPartner->save();
        return redirect(route('modalEditPrototypes.index') .'?refreshMainFrame=1');
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
        return redirect(route('modalEditPrototypes.index'));
    }
}
