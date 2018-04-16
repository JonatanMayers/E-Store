<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    public function run()
    {
        $brands = ["Sony", "Samsung", "Huawei"];

        foreach ($brands as $brand) {
            \App\Brand::create([
                "name" => $brand,
                "slug" => str_slug($brand)
            ]);
        }

    }


}
