<?php


namespace App\Entities\Accommodations;


use App\Entities\Account;
use App\Entities\Geography\City;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Accommodations\Accommodation
 *
 * @property int $id
 * @property int|null $city_id
 * @property string $name
 * @property string $description
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Account $account
 * @property-read \App\Entities\Geography\City|null $city
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Accommodation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Accommodation extends Model
{
    /***
     * @var string
     */
    protected $table = 'accommodations';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'account_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
