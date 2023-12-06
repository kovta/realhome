<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SiteParameter.
 *
 * @package namespace App\Models;
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code_name
 * @property string $description
 * @property int|null $value_numeric
 * @property string|null $value_string
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereCodeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereValueNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteParameter whereValueString($value)
 */
class SiteParameter extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_name',
        'description',
    ];



    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->code_name = 'def-codename';
    }

    public function __get($key)
    {
        if ($key == 'value'){
            return (is_numeric($this->value_numeric)) ? $this->value_numeric : $this->value_string;
        } else {
            return parent::getAttribute($key);
        }
    }


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'code_name' => 'required|max:255|regex:'.'/^([a-zA-Z_-]+)$/',
            'description' => 'required',
            'value' => 'required'];
        return $validationRules;
    }


    /**
     * Az uzleti logikanak megfeleloen letarolja az erteket a modelben: vagy szam, vagy szoveg.
     * @param $value
     */
    public function setValue($value){
        if (is_numeric($value)){
            $this->value_numeric = $value;
            $this->value_string = null;
        } else {
            $this->value_numeric = null;
            $this->value_string = strval($value);
        }
    }


    public function getValue(){
        $result = null;
        if (is_numeric($this->value_numeric) != null){
            $result = $this->value_numeric;
        } else {
            $result = $this->value_string;
        }
        return $result;
    }


    /**
     * @param $codeName
     * @param null $defaultValue
     * @return |null
     */
    public static function getParameterValue($codeName, $defaultValue = null){
        $param = SiteParameter::where('code_name', '=', $codeName)->first();
        return ($param != null) ? $param->getValue() : $defaultValue;
    }


}
