<?php


namespace App\Entities\Accommodations;


use App\Entities\Account;
use App\Entities\Geography\City;
use App\Entities\Helpers\HasPhotos;
use App\Entities\Photo;
use Illuminate\Database\Eloquent\Model;

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
        'name', 'description', 'account_id', 'city_id',
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
}
