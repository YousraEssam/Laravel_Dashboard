<?php

use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            [
                'name' => 'Writer',
                'description' => 'cannot be editted or deleted',
                'created_at' => now(),
            ],
            [
                'name' => 'Reporter',
                'description' => 'cannot be editted or deleted',
                'created_at' => now(),
            ]
        ]);
    }
}
