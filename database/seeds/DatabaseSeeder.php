<?php

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
        $user = \App\Entities\User::where('email', 'jelauc.valerian@gmail.com')->first();
        if (!$user) {
            \App\Entities\User::create([
                'email' => 'jelauc.valerian@gmail.com',
                'name' => 'Valerian',
                'password' => bcrypt('123qwe123'),
                'email_verified_at' => \Carbon\Carbon::now(),
            ]);
        }

        $this->call(GeographySeeder::class);
    }
}
