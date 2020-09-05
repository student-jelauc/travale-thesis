<?php


namespace App\Entities\Accommodations;


use Illuminate\Database\Eloquent\Model;

class AccommodationPhoto extends Model
{
    /**
     * @var string
     */
    protected $table = 'accommodation_photos';

    /**
     * @var array
     */
    protected $fillable = [
        'accommodation_id', 'path', 'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
