<?php


namespace App\Entities\Accommodations;


use App\Entities\Account;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Accommodations\Facility
 *
 * @property int $id
 * @property string $name
 * @property int $rating
 * @property int|null $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Accommodations\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Facility extends Model
{
    protected $table = 'facilities';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'rating'
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
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * @return RoomType|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public static function selectQuery()
    {
        return static::whereAccountId(\Auth::user()->account_id)->orWhereNull('account_id');
    }
}
