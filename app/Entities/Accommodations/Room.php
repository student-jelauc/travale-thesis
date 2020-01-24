<?php


namespace App\Entities\Accommodations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Accommodations\Room
 *
 * @property int $id
 * @property int $accommodation_id
 * @property int $room_type_id
 * @property string $name
 * @property string $floor
 * @property int $adults_capacity
 * @property int $children_capacity
 * @property int $infants_capacity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Accommodations\Accommodation $accommodation
 * @property-read \App\Entities\Accommodations\RoomType $roomType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereAccommodationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereAdultsCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereChildrenCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereInfantsCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Accommodations\Room whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Room extends Model
{
    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'accommodation_id', 'room_type_id', 'floor',
        'adults_capacity', 'children_capacity', 'infants_capacity'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
