<?php

use Illuminate\Database\Seeder;

class AccommodationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Airport Hotel', 'Apartment Hotel', 'Bed and Breakfast',
            'Boarding House', 'Boatel', 'Boutique Hotel', 'Bunkhouse', 'Capsule Hotel',
            'Casa Particular', 'Casino Hotel', 'Chain Hotel', 'Choultry',
            'Conference Hotel', 'Eco Hotel', 'Garden Hotel', 'Guest House', 'Heritage Hotel',
            'Hostel', 'Hotel', 'Hotelship', 'Ice Hotel', 'Love Hotel', 'Luxury Hotel',
            'Motel', 'Pension', 'Resort',
        ];

        foreach ($types as $type) {
            \App\Entities\Accommodations\AccommodationType::firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
