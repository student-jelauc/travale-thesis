<?php


namespace App\Policies;


use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\Room;
use App\Entities\Accommodations\RoomType;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any accommodations.
     *
     * @param User $user
     * @param Accommodation $accommodation
     * @param RoomType|null $type
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('accommodations/view');
    }

    /**
     * Determine whether the user can view the accommodation.
     *
     * @param User $user
     * @param Room $room
     * @return mixed
     */
    public function view(User $user, Room $room)
    {
        return $user->hasPermissionTo('accommodations/view') && $this->appertain($user, $room);
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
     * @param Room $room
     * @return mixed
     */
    public function update(User $user, Room $room)
    {
        return $user->hasPermissionTo('accommodations/update') && $this->appertain($user, $room);
    }

    /**
     * Determine whether the user can delete the accommodation.
     *
     * @param User $user
     * @param Room $room
     * @return mixed
     */
    public function delete(User $user, Room $room)
    {
        return $user->hasPermissionTo('accommodations/delete') && $this->appertain($user, $room);
    }

    /**
     * Determine whether the user can restore the accommodation.
     *
     * @param User $user
     * @param Room $room
     * @return mixed
     */
    public function restore(User $user, Room $room)
    {
        return $user->hasPermissionTo('accommodations/delete') && $this->appertain($user, $room);
    }

    /**
     * Determine whether the user can permanently delete the accommodation.
     *
     * @param User $user
     * @param Room $room
     * @return mixed
     */
    public function forceDelete(User $user, Room $room)
    {
        return $user->hasPermissionTo('accommodations/delete') && $this->appertain($user, $room);
    }

    /**
     * @param User $user
     * @param Room $room
     * @return bool
     */
    protected function appertain(User $user, Room $room)
    {
        return $user->account_id === $room->accommodation->account_id;
    }
}
