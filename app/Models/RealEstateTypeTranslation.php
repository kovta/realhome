<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RealEstateTypeTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $real_estate_type_id
 * @property string $locale
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation whereRealEstateTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstateTypeTranslation whereUpdatedAt($value)
 */
class RealEstateTypeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
