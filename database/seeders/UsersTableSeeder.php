<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $riderRole = config('roles.models.role')::where('name', '=', 'Rider')->first();
        $driverRole = config('roles.models.role')::where('name', '=', 'Driver')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@admin.com')->first() === null) {

            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('123456'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'rider@rider.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Rider',
                'email'    => 'rider@rider.com',
                'password' => bcrypt('123456'),
            ]);

            $newUser->attachRole($riderRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'driver@driver.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Driver',
                'email'    => 'driver@driver.com',
                'password' => bcrypt('123456'),
            ]);

            $newUser->attachRole($driverRole);
        }
    }
}
