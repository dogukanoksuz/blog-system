<?php

use App\Admin\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            ['name' => 'Title', 'value' => 'Doğukan Öksüz']
        );
        DB::table('settings')->insert(
            ['name' => 'Description', 'value' => 'Yazılım dünyasına dair günlüğüm']
        );
        DB::table('settings')->insert(
            ['name' => 'Keywords', 'value' => 'yazılım, php, java, c++, laravel, html, css, web developer, websitesi yaptır, giresun websitesi']
        );
        DB::table('settings')->insert(
            ['name' => 'Social Links', 'value' => json_encode([
                'facebook' => 'https://fb.me',
                'twitter'  => 'https://t.co',
                'instagram' => 'https://instagr.am',
                'steam'     => 'https://steamcommunity.com',
                'linkedin'  => 'www.linkedin.com',
                'mail'      => 'me@dogukan.dev'
            ])]
        );
    }
}
