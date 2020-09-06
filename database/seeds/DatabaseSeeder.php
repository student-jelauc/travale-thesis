<?php

use App\Entities\Account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var \App\Entities\User $user */
        $user = \App\Entities\User::where('email', 'jelauc.valerian@gmail.com')->first();
        if (!$user) {
            $user = \App\Entities\User::create([
                'email' => 'jelauc.valerian@gmail.com',
                'name' => 'Valerian',
                'password' => bcrypt('123qwe123'),
                'email_verified_at' => \Carbon\Carbon::now(),
            ]);

            $account = Account::create([
                'name' => $user->name,
                'master_id' => $user->id,
            ]);

            $user->account_id = $account->id;
            $user->save();
        }

        $this->call(GeographySeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RoomTypesSeeder::class);
        $this->call(FacilitiesSeeder::class);
        $this->call(MealsSeeder::class);
        $this->call(AccommodationTypesSeeder::class);

        if (!$user->hasRole('master')) {
            $user->assignRole('master');
        }
    }
}
