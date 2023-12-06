<?php

namespace App\Observers;

use App\Models\Enum\RealEstateOfferStatusEnum;
use App\Models\RealEstateOffer;
use Illuminate\Support\Facades\Auth;

class RealEstateOfferObserver
{
    /**
     * Handle the real estate "created" event.
     *
     * @param  RealEstateOffer  $realEstateOffer
     * @return void
     */
    public function creating(RealEstateOffer $realEstateOffer)
    {
        $realEstateOffer->created_by_id = Auth::user()->id;
        if ($realEstateOffer->offer_status_enum == null) {
            $realEstateOffer->offer_status_enum = RealEstateOfferStatusEnum::mentett;
        }
    }

    /**
     * Handle the real estate "updated" event.
     *
     * @param  RealEstateOffer  $realEstateOffer
     * @return void
     */
    public function updating(RealEstateOffer $realEstateOffer)
    {
        if ($realEstateOffer->offer_status_enum == RealEstateOfferStatusEnum::vazlat) {
            $realEstateOffer->offer_status_enum = RealEstateOfferStatusEnum::mentett;
        }
    }

    /**
     * Handle the real estate "deleted" event.
     *
     * @param  RealEstateOffer  $realEstateOffer
     * @return void
     */
    public function deleted(RealEstateOffer $realEstateOffer)
    {
        //
    }

    /**
     * Handle the real estate "restored" event.
     *
     * @param  RealEstateOffer  $realEstateOffer
     * @return void
     */
    public function restored(RealEstateOffer $realEstateOffer)
    {
        //
    }

    /**
     * Handle the real estate "force deleted" event.
     *
     * @param  RealEstateOffer  $realEstateOffer
     * @return void
     */
    public function forceDeleted(RealEstateOffer $realEstateOffer)
    {
        //
    }
}
