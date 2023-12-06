<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\RealEstateOffer
 *
 * @property int $id
 * @property int|null $client_id
 * @property string $name
 * @property int $offer_status_enum
 * @property int|null $language_id
 * @property int $maps_included
 * @property int $street_address_included
 * @property int $crop_logo_included
 * @property int $one_page_limit
 * @property int|null $created_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereCreatedbyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereCropLogoIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereMapsIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereOfferStatusEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereOnePageLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereStreetAddressIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $language_enum
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateOffer whereLanguageEnum($value)
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RealEstate[] $realEstates
 * @property-read \App\User|null $createdBy
 * @property-read int|null $real_estates_count
 */
class RealEstateOffer extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'client_id',
        'offer_status_enum',
        'language_enum',
        'maps_included',
        'street_address_included',
        'crop_logo_included',
        'one_page_limit',
        'created_by_id',
        'price_currency_id'
    ];


    /**
     * The attributes that represents a boolean value.
     * @var array
     */
    public $checkboxes = [
        'maps_included',
        'street_address_included',
        'crop_logo_included',
        'one_page_limit',
    ];


    public function client(){
        return $this->belongsTo( '\App\Models\Client');
    }

    public function realEstates(){
        return $this->belongsToMany( '\App\Models\RealEstate', 'real_estate_offer_components', 'offer_id', 'real_estate_id' );
    }

    public function createdBy(){
        return $this->belongsTo( '\App\User');
    }



    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'name' => 'required',
            'language_enum' => 'required',
        ];
        return $validationRules;
    }

    /**
     * @param $offerId
     * @return bool
     */
    public static function hasClientsRequirements($offerId)
    {
        $offer = RealEstateOffer::find($offerId);
        return (($offer->client != null) && ($offer->client->clientRequirement != null));
    }

    /**
     * Admin oldalon ezzel lehet ajanlathoz szurt ingatlan listat kerni.
     * @param $offerId
     * @return string
     */
    public static function getClientsRequirementsParametersString($offerId)
    {
        if (RealEstateOffer::hasClientsRequirements($offerId)) {
            $offer = RealEstateOffer::find($offerId);
            return ClientRequirement::getParametersString($offer->client->clientRequirement->id);
        } else
            return '';
    }

    public static function deepClone($offerId)
    {
        $realEstateOffer = RealEstateOffer::find($offerId)->load('realEstates');
        $clone = $realEstateOffer->replicate();
        $clone->name = 'Cloned from this: '.$realEstateOffer->name;
        $clone->save();
        foreach ($realEstateOffer->realEstates as $item){
            $clone->realEstates()->attach($item);
        }
        return $clone;
    }

}
