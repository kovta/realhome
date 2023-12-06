<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\RouteComponent
 *
 * @property int $id
 * @property int|null $route_id
 * @property int $position
 * @property int|null $real_estate_id
 * @property string $visit_time
 * @property string $comment
 * @property-read \App\Models\RealEstate $realEstate
 * @property-read \App\Models\Route|null $route
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent whereRealEstateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteComponent whereVisitTime($value)
 * @mixin \Eloquent
 */
class RouteComponent extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'route_id',
        'position',
        'real_estate_id',
        'visit_time',
        'comment',
    ];

    public $timestamps = false;


    public function route()
    {
        return $this->belongsTo('\App\Models\Route');
    }

    public function realEstate()
    {
        return $this->belongsTo('\App\Models\RealEstate');
    }


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'route_id' => 'required',
            'real_estate_id' => 'required',
        ];
        return $validationRules;
    }

}
