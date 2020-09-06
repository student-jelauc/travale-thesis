<?php


namespace App\Entities\Stays;


use App\Entities\Accommodations\RoomType;
use App\Entities\Account;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Stays\Meal
 *
 * @property int $id
 * @property string $name
 * @property int $rating
 * @property int|null $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Account|null $account
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meal extends Model
{
    /**
     * @var string
     */
    protected $table = 'meals';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'account_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return RoomType|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public static function selectQuery()
    {
        return static::whereAccountId(\Auth::user()->account_id)->orWhereNull('account_id');
    }
}
