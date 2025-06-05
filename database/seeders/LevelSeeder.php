<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_level')->insert([
            ['level_id' => 1, 'level_code' => 'ADM', 'level_name' => 'Administrator'],
            ['level_id' => 2, 'level_code' => 'DSN', 'level_name' => 'Dosen'],
            ['level_id' => 3, 'level_code' => 'KDR', 'level_name' => 'Koordinator'],
            ['level_id' => 4, 'level_code' => 'DIR', 'level_name' => 'Direktur'],
            ['level_id' => 5, 'level_code' => 'KJM', 'level_name' => 'KJM'],
            ['level_id' => 6, 'level_code' => 'KPD', 'level_name' => 'Kaprodi'],
            ['level_id' => 7, 'level_code' => 'KJR', 'level_name' => 'Kajur'],
        ]);
    }
}
