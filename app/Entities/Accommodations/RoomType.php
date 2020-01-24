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
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
