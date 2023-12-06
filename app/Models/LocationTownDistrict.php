<?php

namespace App\Models;

use App\Http\Traits\SelectableEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\LocationTownDistrict
 *
 * @property-read \App\Models\LocationArea $locationArea
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $location_area_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict whereLocationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationTownDistrict whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LocationNeighborhood[] $locationNeighborhood
 * @property-read int|null $location_neighborhood_count
 */
class LocationTownDistrict extends Model implements Transformable
{
    use TransformableTrait, SelectableEntity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function locationArea(){
        return $this->belongsTo('App\Models\LocationArea');
    }

    public function locationNeighborhood(){
        return $this->hasMany('App\Models\LocationNeighborhood');
    }

    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'name' => 'required|max:150',
            'location_area_id' => 'required',
        ];
        return $validationRules;
    }

    /**
     * Return the location town district of client requirement
     *
     * @param  int $clientRequirementLocationTownDistrictId ClientRequirement->location_town_district_id
     * @return Builder|Model|object|null
     */
    public static function getLocationTownDistrict($clientRequirementLocationTownDistrictId)
    {
        return  self::where('id','=', $clientRequirementLocationTownDistrictId)->first();
    }

}
