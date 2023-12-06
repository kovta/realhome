<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements Transformable, HasMedia
{
    // use HasMediaTrait;
    use InteractsWithMedia;
    use TransformableTrait;
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public array $translatedAttributes = ['title', 'lead', 'description'];

    public function __construct(array $attributes = [])
    {

        /* inject translatable locale codes */
        $this->fillable = array_merge($this->fillable, array_values(config('translatable.locales')));

        parent::__construct($attributes);
    }

    /**
     *  Relathionship with PostTranslation
     *
     * @return HasMany
     */
    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class);
    }

    /**
     * @return array
     */
    public static function validationRules(): array
    {
        $validationRules = [
        ];
        $translatableLocales = config('translatable.locales');
        foreach ($translatableLocales as $locale) {
            $validationRules["$locale.title"] = 'required';
            $validationRules["$locale.lead"] = 'required';
        }
        return $validationRules;
    }

    public function getLastModified() {
        return (is_null($this->updated_at)) ? $this->created_at : $this->updated_at;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // admin
        $this->addMediaConversion('admin-list-thumb')
            ->crop(Manipulations::CROP_CENTER, 70, 70)->nonQueued();

        // public
        $this->addMediaConversion('public-post-list-image')
            ->fit(Manipulations::FIT_FILL, 370, 260)->nonQueued();
        $this->addMediaConversion('public-post-datapage-image')
            ->fit(Manipulations::FIT_FILL, 770, 380)->nonQueued();
        $this->addMediaConversion('public-list-thumb')
            ->crop(Manipulations::CROP_CENTER, 70, 70)->nonQueued();
    }


    /**
     * @return string
     */
    public function getListThumbImage()
    {
        return ($this->getFirstMediaUrl('images', 'admin-list-thumb')) ?: asset('/images/no-pics/no-pic_70px.jpg');
    }

    /**
     * @return string
     */
    public function getPublicListThumbImage(): string
    {
        return ($this->getFirstMediaUrl('images', 'public-list-thumb')) ?: asset('/images/no-pics/no-pic_70px.jpg');
    }

    /**
     * Nyilvanos lista kep
     * @return string
     */
    public function getPublicListFeaturedImage(): string
    {
        return ($this->getFirstMediaUrl('images', 'public-post-list-image')) ?: asset('/images/no-pics/no-pic.jpg');
    }

    /**
     * Nyilvanos adatlap kep
     * @return string
     */
    public function getPublicDatapageFeaturedImage(): string
    {
        return ($this->getFirstMediaUrl('images', 'public-post-datapage-image')) ?: asset('/images/no-pics/no-pic.jpg');
    }

    /**
     * Vissza adja a nyilvanos oldalon a cimet
     * @return string
     */
    public function getPublicTitle(): string
    {
        return ucfirst($this->getTranslation(App::getLocale())->title);
    }

    /**
     * @return false|string|null
     */
    public function getPublicCreatedAt(): bool|string|null
    {
        return ($this->created_at !== null) ? Carbon::createFromTimestamp($this->created_at->timestamp)->isoFormat('%d %B %Y') : null;
    }

}
