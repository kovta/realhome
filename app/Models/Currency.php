<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\Currency
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 * @property int $id
 * @property string $iso_code
 * @property float $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereUpdatedAt($value)
 */
class Currency extends Model implements Transformable
{
    use TransformableTrait, Cachable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iso_code', 'rate'
    ];


    public static $HUF = 1;


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'iso_code' => 'required|max:5|regex:'.'/^([A-Z]+)$/',//|unique:currencies
            'rate' => 'required|regex:'.'/^([0-9.]+)$/',
        ];
        return $validationRules;
    }

}
