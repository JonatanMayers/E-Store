<?php

use Illuminate\Database\Seeder;

class ConditionsTableSeeder extends Seeder
{

    public function run()
    {
        $conditions = ["New", "Half", "Failure"];

        foreach ($conditions as $condition) {
            \App\Condition::create([
                "name" => $condition,
                "slug" => str_slug($condition)
            ]);
        }

    }


}
