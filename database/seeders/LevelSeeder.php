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
            [
                'level_code' => 'ADM',
                'level_name' => 'Administrator',
            ],
            [
                'level_code' => 'DSN',
                'level_name' => 'Dosen',
            ],
            [
                'level_code' => 'KDR',
                'level_name' => 'Koordinator',
            ],
            [
                'level_code' => 'DIR',
                'level_name' => 'Direktur',
            ],
            [
                'level_code' => 'KJM',
                'level_name' => 'KJM',
            ],
            [
                'level_code' => 'KPD',
                'level_name' => 'Kaprodi',
            ],
            [
                'level_code' => 'KJR',
                'level_name' => 'Kajur',
            ]
        ]);
    }
}
