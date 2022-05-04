<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class DemoVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // init
        $this->call(OptionsTableSeeder::class);
        $this->call(AuthorizationSeeder::class);
        // create users
        \App\Models\User::factory(1000)->create();
        //create demo admin
        $this->createUser();
        // //create activitys
        $this->call(ActivityTableSeeder::class);
    }

    /**
     * Create Demo user
     *
     * username: admin
     * email: admin@admin.com
     * password: password
     */
    public function createUser()
    {
        $role = Role::where('name', 'admin')->first();

        return User::firstOrCreate(
            array(
                "username" => "admin",
                "email" => "admin@admin.com",
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ),
            array(
                'id' => Str::uuid(),
                "username" => "admin",
                "email" => "admin@admin.com",
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                "email_verified_at" => now(),
                'role_id' => $role->id,
            )
        );
    }
}
