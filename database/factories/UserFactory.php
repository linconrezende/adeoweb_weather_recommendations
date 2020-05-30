<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    // Creating a product name with a color
    $_name = [];
    array_push($_name, ucfirst($faker->colorName));
    $_secondName = $faker->word();
    // Faker word sometimes return words with only 2 characters. We need at least 2 characters of length to properly create the SKU. For now I will use at least 5
    while (strlen($_secondName) < 5) {
        $_secondName = $faker->word();
    }
    array_push($_name, ucfirst($_secondName));

    // SKU generated with the first 2 letters of the second part of the product name and random numbers (IT SHOULD be unique but it's not for this purpose)
    $_sku = [];
    array_push($_sku, strtoupper(substr($_name[1], 0, 2)));
    array_push($_sku, $faker->randomNumber(7));

    return [
        'sku' =>  join('-', $_sku), // Join the product sku array with a dash between the strings
        'name' => join(' ', $_name), // Join the product name array with a space between the strings
        'price' => $faker->randomFloat(2, 5, 450) // Random price (max 2 decimals as it is defined on the migration)
    ];
});
