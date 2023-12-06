<?php

namespace App\Models;

use App\Http\Traits\SelectableEntity;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Astrotomic\Translatable\Translatable;

/**
 * App\Models\RealEstateType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RealEstateTypeTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType withTranslation()
 * @mixin \Eloquent
 * @property int $id
 * @property int $real_estate_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType whereRealEstateCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateType whereUpdatedAt($value)
 * @property-read \App\Models\RealEstate $realEstateType
 * @property-read \App\Models\RealEstateTypeTranslation $translation
 * @property-read int|null $translations_count
 */
class RealEstateType extends Model implements Transformable
{
    use TransformableTrait, SelectableEntity;
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'real_estate_category_id',
        'real_estate_offer_pdf_green_box',
    ];

    public $translatedAttributes = ['name'];


    public function realEstateType(){
        return $this->belongsTo('App\Models\RealEstate');
    }


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'real_estate_category_id' => 'required',
        ];
        $translatableLocales = config('translatable.locales');
        foreach ($translatableLocales as $locale) {
            $validationRules["$locale.name"] = 'required';
        }
        return $validationRules;
    }
}
