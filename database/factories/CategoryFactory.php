<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //
        'title' => $this->faker->title,
        'image' => $this->faker->imageURL('100','100'),
        'is_parent' => $this->faker->randomElement([true, false]),
        'status' => $this->faker->randomElement(['active', 'inactive']),
        'parent_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
    ];
});
