<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert(
            [
            [
                'name' => 'Alexandria',
                'country_id' => '818',
                'created_at' => now(),
            ],
            [
                'name' => 'Cairo',
                'country_id' => '818',
                'created_at' => now(),

            ],
            [
                'name' => 'Istanbul',
                'country_id' => '792',
                'created_at' => now(),

            ],
            [
                'name' => 'Izmir',
                'country_id' => '792',
                'created_at' => now(),

            ],
            ]
        );
    }
}
