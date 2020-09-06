<?php


namespace App\Entities\Accommodations;


use App\Entities\Account;
use App\Entities\Geography\City;
use App\Entities\Helpers\HasPhotos;
use App\Entities\Photo;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Accommodations\Accommodation
 *
 * @property int $id
 * @property int|null $city_id
 * @property string $name
 * @property int $stars
 * @property string|null $description
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Account $account
 * @property-read City|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection|Photo[] $photos
 * @property-read int|null $photos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Accommodations\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereStars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Accommodation extends Model
{
    use HasPhotos;

    /***
     * @var string
     */
    protected $table = 'accommodations';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'account_id', 'city_id', 'stars', 'type_id'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(AccommodationType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function selectQuery()
    {
        return static::where('account_id', \Auth::user()->account_id);
    }
}
