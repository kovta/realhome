<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdvertisingPartner.
 *
 * @package namespace App\Models;
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertisingPartner whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RealEstate[] $realEstates
 * @property-read int|null $real_estates_count
 */
class AdvertisingPartner extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function realEstates(){
        return $this->belongsToMany('\App\Models\RealEstate','real_estates_advertising_partners');
    }

    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'name' => 'required|max:255',
        ];
        return $validationRules;
    }
}
