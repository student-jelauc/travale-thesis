<?php

use Illuminate\Database\Seeder;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Single', 'Double', 'Triple',
            'Quad', 'Queen', 'King',
            'Twin',
        ];

        foreach ($types as $type) {
            \App\Entities\Accommodations\RoomType::firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
