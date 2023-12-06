<?php

namespace App\Http\Controllers;

use App\Models\LocationArea;
use App\Models\LocationNeighborhood;
use App\Models\LocationTownDistrict;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationSelectorController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function locationAreasQueryAjax(): JsonResponse
    {
        $location_areas = LocationArea::all();
        return response()->json([
            'status' => 'ok',
            'data' => $location_areas
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function locationTownDistrictsQueryAjax(Request $request)
    {
        $requestArray = explode(',', $request->arrayOfAreaId);
        $location_town_district = LocationTownDistrict::whereIn('location_area_id', $requestArray)->get();
        return response()->json([
            'status' => 'ok',
            'data' => $location_town_district
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function locationTownNeighborhoodQueryAjax(Request $request){

        $requestArray = explode(',', $request->arrayOfDistrictId);
        $location_neighborhood_district = LocationNeighborhood::whereIn('location_town_district_id', $requestArray)->get();
        return response()->json([
            'status' => 'ok',
            'data' => $location_neighborhood_district
        ]);
    }

}
