<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hrs')->insert([
            [
            'name' => '小山田　武',
            'memo' => '残業少ない案件希望',
            'price' => 330000,
            ],
            [
            'name' => '鈴山　スネ夫',
            'memo' => '案件単価に関わらず高単価希望',
            'price' => 360000,
            ],
            [
            'name' => '大山　静',
            'memo' => '女性多い現場希望',
            'price' => 340000,
            ],
        ]);
    }
}
