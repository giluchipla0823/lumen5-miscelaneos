<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factory;

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
/** @var Factory $factory */

// Factory Users
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// Factory Categories
$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => 1
    ];
});

// Factory Posts
$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'category_id' => Category::all()->random()->id,
        'title' => $faker->sentence(4),
        'body' => $faker->text(500),
        'active' => 1
    ];
});
