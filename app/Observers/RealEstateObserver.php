<?php

namespace App\Observers;

use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\RealEstate;
use Illuminate\Support\Facades\Auth;

class RealEstateObserver
{

    protected function createCodeValue(RealEstate $realEstate)
    {
        $prefix = '?';
        if ($realEstate->contract_type_enum == RealEstateContractTypeEnum::elado) { $prefix = 'S'; }
        if ($realEstate->contract_type_enum == RealEstateContractTypeEnum::kiado) { $prefix = 'R'; }
        $realEstate->code = $prefix .'-'. $realEstate->id;
    }

    /**
     * Handle the real estate "created" event.
     *
     * @param  RealEstate  $realEstate
     * @return void
     */
    public function creating(RealEstate $realEstate)
    {
        $realEstate->created_by_id = Auth::id();
        //$realEstate->updated_at = now();
//        $realEstate->score = 8;
//        $realEstate->web_appearances = 4185740;
//        $realEstate->web_interestes = 64;
    }

    public function created(RealEstate $realEstate)
    {
        $this->createCodeValue($realEstate);
        $realEstate->save();
    }

    /**
     * Handle the real estate "updated" event.
     *
     * @param  RealEstate  $realEstate
     * @return void
     */
    public function updated(RealEstate $realEstate)
    {
        //
    }

    /**
     * @param RealEstate $realEstate
     */
    public function updating(RealEstate $realEstate)
    {
        if ($realEstate->isDirty('contract_type_enum')){
            $this->createCodeValue($realEstate);
        }
    }

    /**
     * Handle the real estate "deleted" event.
     *
     * @param  RealEstate  $realEstate
     * @return void
     */
    public function deleted(RealEstate $realEstate)
    {
        //
    }

    /**
     * Handle the real estate "restored" event.
     *
     * @param  RealEstate  $realEstate
     * @return void
     */
    public function restored(RealEstate $realEstate)
    {
        //
    }

    /**
     * Handle the real estate "force deleted" event.
     *
     * @param  RealEstate  $realEstate
     * @return void
     */
    public function forceDeleted(RealEstate $realEstate)
    {
        //
    }
}
