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
        $cities = \App\Entities\Geography\City::all();
        $accommodationTypes = \App\Entities\Accommodations\AccommodationType::all();
        $accommodations = collect();
        $account = \App\Entities\User::whereEmail('jelauc.valerian@gmail.com')->first()->account;

        $i = 30;
        while (--$i > 0) {
            $accommodations[] = factory(\App\Entities\Accommodations\Accommodation::class)->create([
                'city_id' => $cities->shuffle()->first(),
                'type_id' => $accommodationTypes->shuffle()->first(),
                'account_id' => $account,
            ]);
        }

        $roomTypes = \App\Entities\Accommodations\RoomType::all();
        $facilities = \App\Entities\Accommodations\Facility::all();
        $accommodations = $accommodations->splice(0, 2);
        foreach ($accommodations as $accommodation) {
            $i = 30;
            while (--$i > 0) {
                /** @var \App\Entities\Accommodations\Room $room */
                $room = factory(\App\Entities\Accommodations\Room::class)->create([
                    'accommodation_id' => $accommodation,
                    'room_type_id' => $roomTypes->shuffle()->first(),
                ]);

                $room->facilities()->sync($facilities->shuffle()->splice(0, 3));
            }
        }
    }
}
