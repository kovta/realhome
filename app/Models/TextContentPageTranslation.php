<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\TextContentPageTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $text_content_page_id
 * @property string $locale
 * @property string|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation whereTextContentPageId($value)
 * @property string|null $title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TextContentPageTranslation whereTitle($value)
 */
class TextContentPageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['content'];
}
