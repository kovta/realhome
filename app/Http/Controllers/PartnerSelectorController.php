<?php

namespace App\Http\Controllers;


use App\Models\Partner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PartnerSelectorController extends Controller
{
    /**
     *  Return the partner selector view
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function partnerSelectorView($id)
    {
        return view('Partner.vue.vue-body',[
            'client_id' => $id
        ]);
    }

    /**
     *  Return the partner list
     *
     * @return JsonResponse
     */
    public function partnerQueryAjax(): JsonResponse
    {
        $partners = Partner::select('id','partner_name as name')->get();
        $listOfPartners = [];

        foreach ($partners as $partner){
            $listOfPartnerObject = (object)[];
            $listOfPartnerObject->label = $partner->name;
            $listOfPartnerObject->code = $partner->id;
            $listOfPartners[] = $listOfPartnerObject;
        }
        return response()->json([
            'status' => 'ok',
            'data' => $listOfPartners
        ]);
    }
}
