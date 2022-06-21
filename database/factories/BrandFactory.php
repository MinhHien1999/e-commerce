<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use Faker\Generator as Faker;

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        //
        'title' => $this->faker->name,
        'slug' => $this->faker->unique()->slug,
        'image' => $this->faker->imageURL('100','100'),
        'status' => $this->faker->randomElement(['active', 'inactive']),
    ];
});
