<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware("admin");
    }

    public function edit()
    {
        $setting = Setting::first();
        return view("admin.settings.edit", compact("setting"));
    }

    public function update(Request $request)
    {
        $data = $this->validate($request, [
            "site_name"      => "required|max:255",
            "contact_number" => "required|max:255",
            "contact_email"  => "required|max:255",
            "address"        => "required|max:255"
        ]);

        $setting = Setting::first();

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->route("settings.edit")
            ->withSuccess("Settings updated successfully !");
    }


}
