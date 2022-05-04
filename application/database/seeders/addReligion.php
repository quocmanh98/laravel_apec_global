<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addReligion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->insert([
            ['religions_name' => 'Phật giáo','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['religions_name' => 'Cơ đốc giáo','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['religions_name' => 'Thiên chúa giáo','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['religions_name' => 'Đạo tin lành','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['religions_name' => 'Hồi giáo','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
            ['religions_name' => 'Do thái giáo','created_at'=> date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
