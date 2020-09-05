<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Photo
 *
 * @property int $id
 * @property string $path
 * @property string $name
 * @property string $entity_id
 * @property string $entity_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Photo extends Model
{
    /**
     * @var string
     */
    protected $table = 'photos';

    /**
     * @var array
     */
    protected $fillable = [
        'entity_id', 'entity_type', 'path', 'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->morphTo();
    }
}
