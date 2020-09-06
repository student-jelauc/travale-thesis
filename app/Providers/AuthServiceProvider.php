<?php

namespace App\Providers;

use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\Room;
use App\Entities\Accommodations\RoomType;
use App\Policies\AccommodationPolicy;
use App\Policies\RoomPolicy;
use App\Policies\RoomTypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Accommodation::class => AccommodationPolicy::class,
        Room::class => RoomPolicy::class,
        RoomType::class => RoomTypePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
