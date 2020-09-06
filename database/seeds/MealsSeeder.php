<?php

use Illuminate\Database\Seeder;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'All Inclusive', 'Ultra All Inclusive', 'OV',
            'Bed and Breakfast', 'Half Board', 'Full Board', 'Self Catering', 'PP', 'ZPR'
        ];

        foreach ($types as $type) {
            \App\Entities\Stays\Meal::firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
