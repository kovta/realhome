<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RealEstateTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $real_estate_type_id
 * @property string $locale
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereRealEstateTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereUpdatedAt($value)
 * @property int|null $real_estate_id
 * @property string|null $marketing_name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereMarketingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTranslation whereRealEstateId($value)
 */
class RealEstateTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['marketing_name', 'description'];
}
