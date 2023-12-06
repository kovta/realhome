<?php

namespace App\Models;

use App\Models\Enum\SpecialOfferPageContractTypeEnum;
use App\Models\Enum\SpecialOfferPageStatusEnum;
use App\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
// use Spatie\MediaLibrary\HasMedia\HasMedia;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
// use Spatie\MediaLibrary\Models\Media;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\SpecialOfferPage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $position
 * @property int|null $contract_type_enum
 * @property int|null $real_estate_type_id
 * @property int|null $location_area_id
 * @property int|null $location_town_district_id
 * @property int|null $location_neighborhood_id
 * @property int|null $price_min
 * @property int|null $price_max
 * @property-read \App\Models\RealEstateType|null $realEstateType
 * @property-read \App\Models\SpecialOfferPageTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SpecialOfferPageTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereContractTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereLocationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereLocationNeighborhoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereLocationTownDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage wherePriceMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage wherePriceMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereRealEstateTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPage withTranslation()
 * @mixin \Eloquent
 */
class SpecialOfferPage extends Model implements Transformable, Sortable
{
    use TransformableTrait;
    use Translatable;
    use SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'contract_type_enum',
        'real_estate_type_id',
        'location_area_id',
        'location_town_district_id',
        'location_neighborhood_id',
        'price_min',
        'price_max',
    ];

    public $sortable = [
        'order_column_name' => 'position',
        'sort_when_creating' => true,
    ];

    public $translatedAttributes = ['menu_name', 'page_text'];

    public function __construct(array $attributes = [])
    {
        /* inject translatable locale codes */
        $this->fillable = array_merge($this->fillable, array_values(config('translatable.locales')));
        parent::__construct($attributes);
    }



    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'contract_type_enum' => 'required',
        ];
        $translatableLocales = config('translatable.locales');
        foreach ($translatableLocales as $locale) {
            $validationRules["$locale.menu_name"] = 'required';
        }
        return $validationRules;
    }


    public function realEstateType(){
        return $this->belongsTo('App\Models\RealEstateType');
    }

    /**
     * A nyilvanos oldal keresojenek lehet vele parametereket megadni.
     * @return array
     */
    public function getSearchMenuParameters(){
        $searchParameters = [
            'offerPage' => $this->id,
            'contract_type' => $this->contract_type_enum,
            'type' => $this->real_estate_type_id,
            'minarea'=> $this->price_min,
            'maxarea'=> $this->price_max,
            'number_bedroom_min'=> '0',
            'number_bedroom_max'=> 0,
            'location_area_id' => $this->location_area_id,
            'location_town_district_id' => $this->location_town_district_id,
            'location_neighborhood_id' => $this->location_neighborhood_id,
            'price' => $this->price_min.';'.$this->price_max,

        ];
        return $searchParameters;
    }


}
