<?php

use Illuminate\Database\Seeder;

class AccommodationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Entities\Accommodations\Accommodation::class)->times(100)->create();
    }
}
