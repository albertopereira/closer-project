<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Entity::class, function (Faker $faker) {
    return [
        'organization_name' => $faker->company,
        'organization_url' => $faker->url,
        'organization_email' => $faker->email,
        'agency_name' => $faker->company,
        'agency_url' => $faker->url,
        'agency_email' => $faker->email,
        'country' => $faker->country,
        'state' => $faker->state,
        'user_id' => function () {
            return factory('App\User')->create()->id;
        }
    ];
});

$factory->define(App\BudgetType::class, function (Faker $faker) {
    return [
        'budget_name' => $faker->randomElement($array = array ('Expenses','Income','Projected')),
        'entity_id' => function () {
            return factory('App\Entity')->create()->id;
        }
    ];
});
