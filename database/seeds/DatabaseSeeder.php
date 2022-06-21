<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(UsersTableSeeder::class);
        factory(Category::class, 100)->create();
        factory(\App\Models\Brand::class, 100)->create();
        factory(\App\Models\Product::class, 100)->create();
        factory(\App\Models\Banner::class, 20)->create();
    }
}
