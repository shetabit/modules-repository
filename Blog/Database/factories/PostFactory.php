<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Blog\Entities\Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->text(100),
        'body' => $faker->text,
        'image' => $faker->imageUrl()
    ];
});
