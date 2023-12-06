<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

/**
 * Class Partner
 * App\Models\Partner
 *
 * @property int id
 * @property string partner_name
 * @property int|null preferred_contact_enum
 * @property string|null contact_name
 * @property string|null contact_email
 * @property string|null contact_phone_1
 * @property string|null contact_phone_2
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 */
class Partner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'partner_name',
        'preferred_contact_enum',
        'contact_name',
        'contact_email',
        'contact_phone_1',
        'contact_phone_2',
    ];

    /**
     * @return HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
