<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

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
