<?php

namespace Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateVisitorRoleTableSeeder::class);

        //Seed the countries
        $this->call('CountriesSeeder');
    }
}
