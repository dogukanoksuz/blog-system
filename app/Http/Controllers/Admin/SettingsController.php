<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'Title',
            'Description',
            'Keywords'
        ]);

        $arr = $request->all();

        Settings::find(1)->update(['value' => $arr['Title']]);
        Settings::find(2)->update(['value' => $arr['Description']]);
        Settings::find(3)->update(['value' => $arr['Keywords']]);

        $social = [
            'facebook' => $arr['facebook'],
            'twitter' => $arr['twitter'],
            'instagram' => $arr['instagram'],
            'steam' => $arr['steam'],
            'linkedin' => $arr['linkedin'],
            'mail' => $arr['mail']
        ];

        $social = json_encode($social);

        Settings::find(4)->update(['value' => $social]);

        $settings = Settings::all();
        $error = 'Başarıyla kaydedildi!';
        return view('admin.settings', compact(['settings', 'error']));
    }
}
