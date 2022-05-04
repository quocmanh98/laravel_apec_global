<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class addNationality extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalitys')->insert([
            ['nationalitys_name' => 'Danish','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Đan Mạch','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Ấn Độ','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Việt Nam','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Mỹ','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Ba Lan','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Tây Ban Nha','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Thụy Điển','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Scotland','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Thụy Sĩ','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Canada','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Na Uy','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Phần Lan','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'English','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Ireland','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['nationalitys_name' => 'Séc','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
