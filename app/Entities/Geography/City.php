<?php


namespace App\Entities\Geography;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Geography\City
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Geography\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Geography\City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    /**
     * @var string
     */
    protected $table = 'cities';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'country_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
