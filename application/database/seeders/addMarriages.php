<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addMarriages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marriages')->insert([
            ['name' => 'Độc thân','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Đính hôn','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Có gia đình','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Ly thân','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Ly hôn','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
