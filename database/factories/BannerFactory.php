<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Banner;
use Faker\Generator as Faker;

$factory->define(App\Models\Banner::class, function (Faker $faker) {
    return [
        //
        'title' => $this->faker->name,
        'slug' => $this->faker->unique()->slug,
        'description' => $this->faker->text,
        'image' => $this->faker->imageURL('100','100'),
        'status' => $this->faker->randomElement(['active', 'inactive']),
    ];
});
