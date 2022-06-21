<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        //
        'title' => $this->faker->title,
        'slug' => $this->faker->unique()->slug,
//        'image' => $this->faker->imageURL('100','100'),
        'is_parent' => $this->faker->randomElement([1, 0]),
        'status' => $this->faker->randomElement(['active', 'inactive']),
        'parent_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
    ];
});
