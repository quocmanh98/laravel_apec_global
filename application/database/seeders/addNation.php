<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addNation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nation')->insert([
            ['name' => 'Kinh','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Tày','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Thái','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Mường','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'H’Mông','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Khmer','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Nùng','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dao','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Hoa','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Gia Rai','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Ê Đê','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Ba Na','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Xơ Đăng','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Sán Chay','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Cơ Ho','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Sán Dìu','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Chăm','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Khơ-me','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'Thổ','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
