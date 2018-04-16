<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    public function run()
    {
        for ($i = 1; $i <= 60; $i++) {

            $rand = rand(1, 16);
            $product = \App\Product::find($rand);

            \App\Comment::create([
                "body"         => "Comment " . $i,
                "user_id"      => rand(1, 3),
                "product_id"   => $product->id,
                "category_id"  => $product->category_id,
                "brand_id"     => $product->brand_id,
                "condition_id" => $product->condition_id,
                "status"       => rand(0, 1)
            ]);
        }

    }


}
