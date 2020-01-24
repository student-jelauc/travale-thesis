<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Account
 *
 * @property int $id
 * @property string $name
 * @property int|null $master_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\User|null $master
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Account whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Account extends Model
{
    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * @var array
     */
    protected $fillable = ['name', 'master_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function master()
    {
        return $this->belongsTo(User::class);
    }
}
