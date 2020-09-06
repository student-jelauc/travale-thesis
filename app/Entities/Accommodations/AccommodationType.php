<?php


namespace App\Entities\Accommodations;


use App\Entities\Account;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Entities\Accommodations\AccommodationType
 *
 * @property int $id
 * @property string $name
 * @property int $rating
 * @property int|null $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Accommodations\Accommodation[] $accommodations
 * @property-read int|null $accommodations_count
 * @property-read Account|null $account
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccommodationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccommodationType extends Model
{
    /**
     * @var string
     */
    protected $table = 'accommodation_types';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'account_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'type_id');
    }

    /**
     * @return RoomType|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public static function selectQuery()
    {
        return static::whereAccountId(\Auth::user()->account_id)->orWhereNull('account_id');
    }
}
