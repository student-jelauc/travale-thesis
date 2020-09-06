<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['view', 'create', 'update', 'delete'] as $action) {
            \Spatie\Permission\Models\Permission::firstOrCreate([
                'name' => "accommodations/$action",
            ]);
        }
    }
}
