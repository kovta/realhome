<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\SpecialOfferPageTranslation
 *
 * @property int $id
 * @property int|null $special_offer_page_id
 * @property string $locale
 * @property string $menu_name
 * @property string $page_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation whereMenuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation wherePageText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpecialOfferPageTranslation whereSpecialOfferPageId($value)
 * @mixin \Eloquent
 */
class SpecialOfferPageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['menu_name', 'page_text'];
}
