<?php


namespace App\Policies;


use App\Entities\Accommodations\RoomType;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomTypePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('accommodations/view');
    }

    /**
     * Determine whether the user can view the accommodation.
     *
     * @param User $user
     * @param RoomType $roomType
     * @return mixed
     */
    public function view(User $user, $roomType)
    {
        return $user->hasPermissionTo('accommodations/view') && $this->appertain($user, $roomType);
    }

    /**
     * Determine whether the user can create accommodations.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('accommodations/create');
    }

    /**
     * Determine whether the user can update the accommodation.
     *
     * @param User $user
     * @param RoomType $roomType
     * @return mixed
     */
    public function update(User $user, $roomType)
    {
        return $user->hasPermissionTo('accommodations/update') && $this->appertain($user, $roomType);
    }

    /**
     * Determine whether the user can delete the accommodation.
     *
     * @param User $user
     * @param RoomType $roomType
     * @return mixed
     */
    public function delete(User $user, $roomType)
    {
        return $user->hasPermissionTo('accommodations/delete') && $this->appertain($user, $roomType);
    }

    /**
     * Determine whether the user can restore the accommodation.
     *
     * @param User $user
     * @param RoomType $roomType
     * @return mixed
     */
    public function restore(User $user, $roomType)
    {
        return $user->hasPermissionTo('accommodations/delete') && $this->appertain($user, $roomType);
    }

    /**
     * @param User $user
     * @param RoomType $roomType
     * @return bool
     */
    protected function appertain(User $user, $roomType)
    {
        return $user->account_id === $roomType->account_id;
    }
}
