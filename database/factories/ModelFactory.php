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
$factory->define(\App\Models\Post::class, function (Faker\Generator $faker) {
    $title = $faker->unique()->sentence(mt_rand(3, 10));

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->text,
        'type' => \App\Enums\PostType::ARTICLE,
    ];
});
