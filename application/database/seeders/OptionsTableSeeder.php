<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            "app_name" => "Du7 - Laravel Admin",
            "app_description" => "Du7 Laravel Stater kits and admin generator",
            "app_favicon" => '/uploads/default/favicon.ico',
            "app_logo-abbr" => '/uploads/default/logo.png',
            "app_logo-compact" => '/uploads/default/logo-text.png',
            "app_brand-title" => '/uploads/default/logo-text.png',
            "app_copyright" => "Copyright © <a href='/'>JUBAYED</a> 2021",
            //auth
            "auth_disableRegistration" => 0,
            "auth_rememberMe" => 1,
            "auth_forgotPassword" => 1,
            "auth_verifyEmail" => 0,
            "notifications_signup_email" => 0,
        ];

        option($data);
    }

}
