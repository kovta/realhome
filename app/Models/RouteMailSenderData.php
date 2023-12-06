<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\RouteMailSenderData
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteMailSenderData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteMailSenderData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RouteMailSenderData query()
 * @mixin \Eloquent
 */
class RouteMailSenderData extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'route_id',
        'sender',
        'target',
        'subject',
        'format',
        'message'
    ];


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            // 'sender' => 'required',
            'target' => 'required',
            'subject' => 'required',
            //'format' => 'required',
            //'message' => 'required',
        ];
        return $validationRules;
    }


}
