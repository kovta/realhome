<?php

namespace App\Http\Controllers;

use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\RealEstateType;
use App\Models\SpecialOfferPage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SpecialOfferPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = SpecialOfferPage::all()->sortBy('position');
        return view('SpecialOfferPage.list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $special_offer_page = new SpecialOfferPage();
        $special_offer_page->position = 1;
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([ old('contract_type_enum', $special_offer_page->contract_type_enum) ]);
        return view('SpecialOfferPage.datapage.create', [
            'record' => $special_offer_page,
            'contract_types' => $contractTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(SpecialOfferPage::validationRules());
        $special_offer_page = new SpecialOfferPage();
        $data = $request->only($special_offer_page->getFillable());
        $special_offer_page->fill($data);
        $special_offer_page->save();
        return redirect(route('specialOfferPages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * @param SpecialOfferPage $specialOfferPage
     * @return Factory|View
     */
    public function edit(SpecialOfferPage $specialOfferPage)
    {
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([ old('contract_type_enum', $specialOfferPage->contract_type_enum) ]);
        $realEstateTypes = RealEstateType::all();

        return view('SpecialOfferPage.datapage.edit', [
            'record' => $specialOfferPage,
            'contract_types' => $contractTypes,
            'realEstateTypes' => $realEstateTypes,
        ]);

    }

    /**
     * @param Request $request
     * @param SpecialOfferPage $specialOfferPage
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, SpecialOfferPage $specialOfferPage)
    {
//        dd($request->all(), $specialOfferPage);
        $request->validate(SpecialOfferPage::validationRules());

        $data = $request->only($specialOfferPage->getFillable());
        $specialOfferPage->fill($data);
        $specialOfferPage->save();
        return redirect(route('specialOfferPages.index'));
    }

    /**
     * @param SpecialOfferPage $specialOfferPage
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(SpecialOfferPage $specialOfferPage)
    {
        $specialOfferPage->delete();
        return redirect(route('specialOfferPages.index'));
    }


    /**
     * @return SpecialOfferPage[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getOfferPageMenuItems()
    {
        $records = SpecialOfferPage::all()->sortBy('position', true);
        return $records;
    }

    /**
     * @param SpecialOfferPage $specialOfferPage
     * @return RedirectResponse|Redirector
     */
    public function down(SpecialOfferPage $specialOfferPage)
    {
        $specialOfferPage->moveOrderDown();
        $specialOfferPage->save();
        return redirect(route('specialOfferPages.index'));
    }

    /**
     * @param SpecialOfferPage $specialOfferPage
     * @return RedirectResponse|Redirector
     */
    public function up(SpecialOfferPage $specialOfferPage)
    {
        $specialOfferPage->moveOrderUp();
        $specialOfferPage->save();
        return redirect(route('specialOfferPages.index'));
    }

}
