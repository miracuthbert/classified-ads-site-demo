<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'country' => $faker->country,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Role::class, function(Faker\Generator $faker) {

    return [
        'title' => $faker->jobTitle,
        'details' => $faker->text(160),
    ];

});

$factory->define(\App\Models\Listing::class, function(Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(6),
        'body' => $faker->paragraphs(5, true),
        'area_id' => \App\Models\Area::where('usable', true)->get()->pluck('id')->random(),
        'category_id' => \App\Models\Category::where('usable', true)->get()->pluck('id')->random(),
        'live' => true,
    ];

});
