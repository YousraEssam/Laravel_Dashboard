<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory 
 */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// $factory->define(User::class, function (Faker $faker) {
//     $user = [
//         'first_name' => $faker->name,
//         'last_name' => $faker->name,
//         'phone' => $faker->phoneNumber,
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => Hash::make('secret1234'),
//         'remember_token' => Str::random(10),
//     ];
//     $role = Role::select('id')->where('name','Visitor')->get();
//     dd($role);
//     $user->assignRole([$role->id]);

//     return $user;
// });
