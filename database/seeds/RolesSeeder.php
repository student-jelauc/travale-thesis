<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'master' => [
                'accommodations/view',
                'accommodations/create',
                'accommodations/delete',
                'accommodations/update',
            ],
        ];

        foreach ($roles as $role => $permissions) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate([
                'name' => $role,
            ]);

            $role->syncPermissions($permissions);
        }
    }
}
