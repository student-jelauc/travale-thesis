<?php


namespace App\Entities\Accommodations;


use App\Entities\Helpers\HasPhotos;
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
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Accommodations\Accommodation $accommodation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Accommodations\RoomPhoto[] $photos
 * @property-read int|null $photos_count
 * @property-read \App\Entities\Accommodations\RoomType $roomType
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAccommodationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAdultsCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereChildrenCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereInfantsCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Accommodations\Facility[] $facilities
 * @property-read int|null $facilities_count
 */
class Room extends Model
{
    use HasPhotos;

    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'accommodation_id', 'room_type_id', 'floor',
        'adults_capacity', 'children_capacity', 'infants_capacity', 'description'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function facilities()
    {
        return $this->morphToMany(Facility::class, 'entity', 'entity_has_facility');
    }
}
