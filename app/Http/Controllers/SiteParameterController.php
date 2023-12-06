<?php

namespace App\Http\Controllers;

use App\Models\SiteParameter;
use Illuminate\Http\Request;

class SiteParameterController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = SiteParameter::all();
        return view('SiteParameter.siteparameter-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new SiteParameter();
        return view('SiteParameter.siteparameter-create', ['record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(SiteParameter::validationRules());

        $entity = new SiteParameter();
        $entity->code_name = $request->code_name;
        $entity->description = $request->description;
        $entity->setValue($request->value);
        $entity->save();
        return redirect(route('siteParameters.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteParameter  $siteParameter
     * @return \Illuminate\Http\Response
     */
    public function show(SiteParameter $siteParameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteParameter  $siteParameter
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteParameter $siteParameter)
    {
        return view('SiteParameter.siteparameter-edit', ['record' => $siteParameter]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteParameter  $siteParameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteParameter $siteParameter)
    {
        $request->validate(SiteParameter::validationRules());
        /*$request->validate([
            'code_name' => 'required|max:255|regex:'.$this::nameRegex,
            'description' => 'required',
        ]);*/

        $siteParameter->code_name = $request->code_name;
        $siteParameter->description = $request->description;
        $siteParameter->setValue($request->value);
        $siteParameter->save();
        return redirect(route('siteParameters.index'));
    }

    /**
     * @param SiteParameter $siteParameter
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(SiteParameter $siteParameter)
    {
        $siteParameter->delete();
        return redirect(route('siteParameters.index'));
    }
}
