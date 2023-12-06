<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


/**
 * App\Models\TextContentPage
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TextContentPageTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage withTranslation()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $inner_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage whereInnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPage whereUpdatedAt($value)
 * @property-read \App\Models\TextContentPageTranslation $translation
 * @property-read int|null $translations_count
 */
class TextContentPage extends Model implements Transformable
{
    use TransformableTrait;
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inner_name',
    ];

    public $translatedAttributes = ['title', 'content'];


    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'inner_name' => 'required'
        ];
        return $validationRules;
    }


    /**
     * @param $innerName
     * @param null $default
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     * @throws \Exception
     */
    public static function getPage($innerName, $default = null)
    {
        $page = TextContentPage::where('inner_name', '=', $innerName)->first();
        if ($page == null){
            throw new \Exception('There is no TextContentPage record for "'.$innerName.'"!');
        }
        return $page;
    }
}
