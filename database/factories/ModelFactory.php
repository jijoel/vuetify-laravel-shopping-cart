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

$factory->define(
    App\Cart::class,
    function (Faker\Generator $faker)
    use ($factory)
{
    return [
        'user_id' => $factory->create(App\Profile::class)->id,
    ];
});


$factory->define(
    App\Product::class,
    function (Faker\Generator $faker)
{
    return [
        'title' => $faker->text,
        'description' => $faker->paragraph,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'price' => $faker->numberBetween(1, 400000),
        'inventory' => $faker->numberBetween(1, 100),
        'shipping' => $faker->numberBetween(1, 200),
    ];
});


$factory->define(
    App\Profile::class,
    function (Faker\Generator $faker)
{
    return [
        'first' => $faker->firstName,
        'last' => $faker->lastName,
        'limit' => $faker->numberBetween(200,1000000),
    ];
});


$factory->define(
    App\Promotion::class,
    function (Faker\Generator $faker)
{
    return [
        'title' => $faker->text,
    ];
});


$factory->define(
    App\User::class,
    function (Faker\Generator $faker)
{
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
