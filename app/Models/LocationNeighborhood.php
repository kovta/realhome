<?php

namespace App\Models;

use App\Http\Traits\SelectableEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\LocationNeighborhood
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $location_town_district_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood whereLocationTownDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocationNeighborhood whereUpdatedAt($value)
 * @property-read \App\Models\LocationTownDistrict $locationTownDistrict
 */
class LocationNeighborhood extends Model implements Transformable
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

    public function locationTownDistrict(){
        return $this->belongsTo('App\Models\LocationTownDistrict');
    }

    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'name' => 'required|max:150',
            'location_town_district_id' => 'required',
        ];
        return $validationRules;
    }

    /**
     * Return the location neighborhood of client requirement
     *
     * @param  int $clientRequirementLocationNeighborhoodId ClientRequirement->location_neighborhood_id
     * @return Builder|Model|object|null
     */
    public static function getLocationNeighborhood($clientRequirementLocationNeighborhoodId)
    {
        return  self::where('id','=', $clientRequirementLocationNeighborhoodId)->first();
    }

}
