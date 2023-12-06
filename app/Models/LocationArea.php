<?php

namespace App\Models;


use App\Http\Traits\SelectableEntity;
use GeneaLabs\LaravelModelCaching\Traits\Caching;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


/**
 * App\Models\LocationArea
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LocationTownDistrict[] $locationTownDistrict
 * @method static Builder|\App\Models\LocationArea newModelQuery()
 * @method static Builder|\App\Models\LocationArea newQuery()
 * @method static Builder|\App\Models\LocationArea query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|\App\Models\LocationArea whereCreatedAt($value)
 * @method static Builder|\App\Models\LocationArea whereId($value)
 * @method static Builder|\App\Models\LocationArea whereName($value)
 * @method static Builder|\App\Models\LocationArea whereUpdatedAt($value)
 * @property-read int|null $location_town_district_count
 */
class LocationArea extends Model implements Transformable
{
    use TransformableTrait, SelectableEntity;
    use Caching;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function locationTownDistrict(){
        return $this->hasMany('App\Models\LocationTownDistrict');
    }


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'name' => 'required|max:150',
        ];
        return $validationRules;
    }

    /**
     * Return the location area of client requirement
     *
     * @param  int $clientRequirementLocationAreaId ClientRequirement->location_area_id
     * @return Builder|Model|object|null
     */
    public static function getLocationArea($clientRequirementLocationAreaId)
    {
        return  self::where('id','=', $clientRequirementLocationAreaId)->first();
    }


}
