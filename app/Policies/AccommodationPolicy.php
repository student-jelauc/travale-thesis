<?php


namespace App\Policies;


use App\Entities\Accommodations\Accommodation;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccommodationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any accommodations.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the accommodation.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Accommodations\Accommodation  $accommodation
     * @return mixed
     */
    public function view(User $user, Accommodation $accommodation)
    {
        //
    }

    /**
     * Determine whether the user can create accommodations.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the accommodation.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Accommodations\Accommodation  $accommodation
     * @return mixed
     */
    public function update(User $user, Accommodation $accommodation)
    {
        //
    }

    /**
     * Determine whether the user can delete the accommodation.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Accommodations\Accommodation  $accommodation
     * @return mixed
     */
    public function delete(User $user, Accommodation $accommodation)
    {
        //
    }

    /**
     * Determine whether the user can restore the accommodation.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Accommodations\Accommodation  $accommodation
     * @return mixed
     */
    public function restore(User $user, Accommodation $accommodation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the accommodation.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Accommodations\Accommodation  $accommodation
     * @return mixed
     */
    public function forceDelete(User $user, Accommodation $accommodation)
    {
        //
    }
}
