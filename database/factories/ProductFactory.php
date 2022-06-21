<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        //
        'title' => $this->faker->name,
        'slug' => $this->faker->unique()->slug,
        'image' => $this->faker->imageURL('100','100'),
        'stock' => $this->faker->numberBetween(1,50),
        'price' => $this->faker->numberBetween(5000,500000),
        'description' => $this->faker->text,
        'brand_id' => $this->faker->randomElement(\App\Models\Brand::pluck('id')->toArray()),
        'cat_id' => $this->faker->randomElement(\App\Models\Category::where('is_parent',1)->pluck('id')->toArray()),
        'child_cat_id' => $this->faker->randomElement(\App\Models\Category::where('is_parent',0)->pluck('id')->toArray()),
        'discount' => $this->faker->randomFloat(8,2,2),
        'status' => $this->faker->randomElement(['active', 'inactive']),
    ];
});
