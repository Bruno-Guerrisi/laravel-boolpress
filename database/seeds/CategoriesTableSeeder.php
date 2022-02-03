<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['adventure', 'romantic', 'fantasy', 'comic'];


        foreach ($categories as $category) {

            $new_categories = new Category();

            $new_categories->name = $category;
            $new_categories->slug = Str::slug($new_categories->name, '-');

            $new_categories->save();
        }

    }
}
