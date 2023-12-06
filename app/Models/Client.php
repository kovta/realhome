<?php

namespace App\Models;

use App\Models\Enum\UserTypeEnum;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Validation\Rule;
use App\Models\Partner;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $email
 * @property int $status_enum
 * @property string|null $phone_1
 * @property string|null $phone_2
 * @property int|null $preferred_contact_enum
 * @property string|null $contact_name
 * @property string|null $contact_email
 * @property string|null $contact_phone_1
 * @property string|null $contact_phone_2
 * @property string|null $partner
 * @property int|null $source_enum
 * @property string|null $broker
 * @property string|null $last_contacted
 * @property string|null $nationality
 * @property int|null $number_tenants
 * @property int|null $number_children
 * @property string|null $children_age
 * @property string|null $required_school
 * @property string|null $pet
 * @property string|null $moveindate
 * @property string|null $comment
 * @property int|null $client_user_id
 * @property-read \App\User|null $clientUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBroker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereChildrenAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereClientUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereContactPhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereContactPhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereLastContacted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereMoveindate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereNumberChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereNumberTenants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePartner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePreferredContactEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereRequiredSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereSourceEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereStatusEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\User|null $user
 * @property int $type_enum
 * @property int $user_id
 * @property int|null $broker_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUserId($value)
 * @property int|null $required_school_enum
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereRequiredSchoolEnum($value)
 * @property-read \App\Models\ClientRequirement $clientRequirement
 * @property int $client_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereClientId($value)
 */
class Client extends Model implements Transformable, Auditable
{
    use TransformableTrait;
    use \OwenIt\Auditing\Auditable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_enum',
        'phone_1',
        'phone_2',
        'preferred_contact_enum',
        'partner_id',
        'source_enum',
        'broker_id',
        'last_contacted',
        'nationality',
        'number_tenants',
        'number_children',
        'children_age',
        'required_school_enum',
        'pet',
        'moveindate',
        'comment',
        'name',
        'email',
    ];

    /**
     * Attributes to include in the Audit.
     * Empty array = all properties
     *
     * @var array
     */
    protected $auditInclude = [];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * @return HasOne
     */
    public function clientRequirement(): HasOne
    {
        return $this->hasOne(ClientRequirement::class);
    }

    /**
     * @return array
     */
    public static function validationRules($id = null)
    {
        $validationRules = [
            'name' => 'required|string|max:200',
            //  'email' => 'required|email|unique:users',           // |unique:users,id,'.$id,
            'email' => [
                    'required',
                    Rule::unique('clients')->ignore($id),
                ],
            'status_enum' => 'required',
        ];
        return $validationRules;
    }

}
