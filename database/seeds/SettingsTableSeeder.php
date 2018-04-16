<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        \App\Setting::create([
            "site_name"      => "My Store",
            "contact_number" => "064/02-09-601",
            "contact_email"  => "dejanstankovicle@gmail.com",
            "address"        => "Serbia"
        ]);

    }


}
