<?php

use Illuminate\Database\Seeder;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['Sea Side', 90],
            ['Mountain View', 90],
            ['Wi-Fi', 10],
            ['TV', 5],
            ['AC', 15],
        ];

        foreach ($types as $type) {
            \App\Entities\Accommodations\Facility::firstOrCreate([
                'name' => $type[0],
                'rating' => $type[1],
            ]);
        }
    }
}
