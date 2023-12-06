<?php

namespace App\Http\Controllers;

use App\Models\Enum\RealEstateCategory;
use App\Models\Enum\RealEstateCategoryEnum;
use Illuminate\Http\Request;
use \App\Models\RealEstateType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RealEstateTypeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = RealEstateType::all();
        return view('RealEstateType.realestatetype-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $realEstateType = new RealEstateType();
        $categories = RealEstateCategoryEnum::toSelectValueSet([$realEstateType->real_estate_category_id]);
        return view('RealEstateType.realestatetype-create', ['record' => $realEstateType, 'categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(RealEstateType::validationRules());

        $realEstateType = new RealEstateType();
        $realEstateType->real_estate_category_id = $request->real_estate_category_id;
        foreach(config('translatable.locales') as $locale) {
            $realEstateType->translateOrNew($locale)->name = $request->input("$locale.name");
        }
        $realEstateType->save();
        return redirect(route('realEstateTypes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RealEstateType  $realEstateType
     * @return \Illuminate\Http\Response
     */
    public function show(RealEstateType $realEstateType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RealEstateType  $realEstateType
     * @return \Illuminate\Http\Response
     */
    public function edit(RealEstateType $realEstateType)
    {
        $translation = $realEstateType->translateOrDefault(Session::get('editedLanguage'));
        $categories = RealEstateCategoryEnum::toSelectValueSet([$realEstateType->real_estate_category_id]);
        return view('RealEstateType.realestatetype-edit', ['record' => $realEstateType, 'categories' => $categories, 'translation' => $translation ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RealEstateType  $realEstateType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RealEstateType $realEstateType)
    {
        $request->validate(RealEstateType::validationRules());

        $realEstateType->real_estate_category_id = $request->real_estate_category_id;
        foreach(config('translatable.locales') as $locale) {
            $realEstateType->translateOrNew($locale)->name = $request->input("$locale.name");
        }
        $realEstateType->save();
        return redirect(route('realEstateTypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RealEstateType $realEstateType
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(RealEstateType $realEstateType)
    {
        $realEstateType->delete();
        return redirect(route('realEstateTypes.index'));
    }
}
