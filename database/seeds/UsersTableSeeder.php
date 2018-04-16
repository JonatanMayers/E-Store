<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {

        \App\User::create([
            "name"     => "Dejan",
            "slug"     => str_slug("Dejan"),
            "email"    => "dejanstankovicle@gmail.com",
            "password" => bcrypt("123123"),
            "is_admin" => 1,
            "photo_id" => 17,
            'about'    => 'Laravel programmer',
            'facebook' => 'https://www.facebook.com/Dejan.Night',
            'youtube'  => 'https://www.youtube.com/channel/UC1MwdCm5qc5GmvcOEEpSgLw?view_as=subscriber'
        ]);

        \App\User::create([
            "name"     => "Bojan",
            "slug"     => str_slug("Bojan"),
            "email"    => "bojan@gmail.com",
            "password" => bcrypt("123123"),
            "is_admin" => 1,
            "photo_id" => 18
        ]);

        \App\User::create([
            "name"     => "Jelena",
            "slug"     => str_slug("Jelena"),
            "email"    => "jelena@gmail.com",
            "password" => bcrypt("123123"),
            "photo_id" => 19
        ]);

    }
}
