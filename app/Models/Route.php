<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\Route
 *
 * @property int $id
 * @property int|null $offer_id
 * @property int|null $client_id
 * @property string $date
 * @property string $meeting_location
 * @property int|null $presenter_id
 * @property string $comment
 * @property int|null $created_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Client|null $createdBy
 * @property-read \App\Models\RealEstateOffer|null $offer
 * @property-read \App\Models\Client|null $presenter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteComponent[] $routeComponents
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereMeetingLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route wherePresenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Route whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\User $user
 * @property-read int|null $route_components_count
 */
class Route extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'offer_id',
        'client_id',
        'date',
        'meeting_location',
        'presenter_id',
        'created_by_id',
        'comment'
    ];


    public function client()
    {
        return $this->belongsTo('\App\Models\Client');
    }

    public function presenter()
    {
        return $this->belongsTo('\App\User');
    }


    public function createdBy()
    {
        return $this->belongsTo('\App\User');
    }

    public function offer(){
        return $this->belongsTo( '\App\Models\RealEstateOffer');
    }

    public function routeComponents(){
        return $this->hasMany( 'App\Models\RouteComponent');
    }


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            // ezek jonnek az ajanlatbol...
            //'offer_id' => 'required',
            //'client_id' => 'required',
        ];
        return $validationRules;
    }

    /**
     * Ujra indexel minden elemet 1-tol a position-ban
     * @param int $routeId
     * @return bool
     */
    public static function reindexItems(int $routeId)
    {
        $list = DB::table('route_components')
            ->where('route_id', '=', $routeId)
            ->orderBy('position')
            ->get();
        $maxPosition = 1;
        foreach ($list as $item){
            DB::table('route_components')
                ->where('id', '=', $item->id)
                ->update(['position' => $maxPosition]);
            $maxPosition++;
        }
        return true;
    }

}
