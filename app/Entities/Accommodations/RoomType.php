<?php


namespace App\Entities\Accommodations;


use App\Entities\Account;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Accommodations\RoomType
 *
 * @property int $id
 * @property string $name
 * @property int|null $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Account|null $account
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\RoomType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Accommodations\Room[] $rooms
 * @property-read int|null $rooms_count
 */
class RoomType extends Model
{
    /**
     * @var string
     */
    protected $table = 'room_types';

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
