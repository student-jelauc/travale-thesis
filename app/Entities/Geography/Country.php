<?php


namespace App\Entities\Geography;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Geography\Country
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Geography\City[] $cities
 * @property-read int|null $cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\Country whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    /**
     * @var string
     */
    protected $table = 'countries';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class)->orderBy('name');
    }
}
