<?php

use App\Entities\Geography\Country;
use App\Entities\Geography\City;
use Illuminate\Database\Seeder;

class GeographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Country::count()) {
            return;
        }

        $countries = factory(Country::class)->times(5)->create();
        /** @var Country $country */
        foreach ($countries as $country) {
            $country->cities()->createMany(factory(City::class)->times(10)->make()->toArray());
        }

    }
}
