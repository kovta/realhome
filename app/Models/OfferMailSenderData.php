<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OfferMailSenderData
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferMailSenderData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferMailSenderData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferMailSenderData query()
 * @mixin \Eloquent
 */
class OfferMailSenderData extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'offer_id',
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
