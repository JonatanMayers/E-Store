<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        $categories = ["TV", "Mobile", "Laptop", "Computer", "SmartWatch", "Tablet"];

        foreach ($categories as $category) {
            \App\Category::create([
                "name" => $category,
                "slug" => str_slug($category)
            ]);
        }

    }


}
