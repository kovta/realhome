<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\PostTranslation
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $post_id
 * @property string $locale
 * @property string $title
 * @property string $lead
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereLead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'lead',
        'description'
    ];

    /**
     *  Relationship with Post
     *
     * @return BelongsTo
     */
    public function post():BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
