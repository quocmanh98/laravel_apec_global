<?php

namespace App\Support;

use Illuminate\Encryption\Encrypter;
use Str;

class Installer {

    /**
     * get site url
     * so assets url is different
     * @return string
     */
    public static function get_site_url($path = "")
    {
        $url = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
    
        $url .= request()->getHttpHost();

        if($path != ""){
            $url .= $path;
        }

        $url = Str::of( $url )->rtrim('/');
        return $url;
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    public static function generateRandomKey()
    {
        return 'base64:'.base64_encode(
            Encrypter::generateKey( config('app.cipher'))
        );
    }

    /**
     * Update ortions
     *
     * @return void
     */
    public static function getOptions()
    {
        
        return [
            "app_name" => "Du7 - Laravel Admin",
            "app_description" => "Du7 Laravel cms admin generator",
            "app_favicon" => self::get_site_url('/uploads/default/favicon.ico') ,
            "app_logo-abbr" => self::get_site_url('/uploads/default/logo.png'),
            "app_logo-compact" => self::get_site_url('/uploads/default/logo-text.png'),
            "app_brand-title" => self::get_site_url( '/uploads/default/logo-text.png') ,
            "app_copyright" => "Copyright © <a href='/'>JUBAYED</a> 2021",
            //auth
            "auth_disableRegistration" => 0,
            "auth_rememberMe" => 1,
            "auth_forgotPassword" => 1,
            "auth_verifyEmail" => 0,
            "notifications_signup_email" => 0,
        ];
    }

    /**
     * @return array
     */
    public static function getRequirements()
    {
        $requirements = [
            "PHP Version (>=". config('installer.core.minPhpVersion') .")" => version_compare(phpversion(), config('installer.core.minPhpVersion'), '>='),
        ];

        foreach ( config('installer.requirements.php') as $extension) {
            $requirements[$extension . ' Extension'] = extension_loaded($extension);
        }

        if (extension_loaded('xdebug')) {
            $requirements['Xdebug Max Nesting Level (>= 500)'] = (int)ini_get('xdebug.max_nesting_level') >= 500;
        }

        return $requirements;
    }

    /**
     * @return array
     */
    public static function getPermissions()
    {
        return [
            'storage/app'                   => is_writable(storage_path('app')),
            'storage/framework/cache'       => is_writable(storage_path('framework/cache')),
            'storage/framework/sessions'    => is_writable(storage_path('framework/sessions')),
            'storage/framework/views'       => is_writable(storage_path('framework/views')),
            'storage/logs'                  => is_writable(storage_path('logs')),
            'bootstrap/cache'               => is_writable(base_path('bootstrap/cache')),
            '/ (Root Directory)'            => substr(sprintf('%o', fileperms(base_path())), -4) > 0750,
        ];
    }

}