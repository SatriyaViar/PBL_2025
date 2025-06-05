<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_user')->insert([
            [
                'level_id' => 1, // Pastikan ini sesuai dengan level_id yang ada di m_levels
                'username' => 'admin',
                'nidn' => 'null',
                'email' => 'admin@gmail.com',
                'name' => 'Admin User',
                'password' => Hash::make('12345678'), // Password yang sudah di-hash
            ],
            [
                'level_id' => 2,
                'username' => 'johndoe',
                'nidn' => '19012912312121',
                'email' => 'johndoe@gmail.com',
                'name' => 'John Doe',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 2,
                'username' => 'jane_smith',
                'nidn' => '19012912312121',
                'email' => 'jane_smith@gmail.com',
                'name' => 'Jane Smith',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 3,
                'username' => 'koordinator',
                'nidn' => '19012912312121',
                'email' => 'koordinator@gmail.com',
                'name' => 'Koordinator One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 3,
                'username' => 'koordinator2',
                'nidn' => '19012912312121',
                'email' => 'koordinator2@gmail.com',
                'name' => 'Koordinator Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 4,
                'username' => 'Direktur',
                'nidn' => '19012912312121',
                'email' => 'Direktur@gmail.com',
                'name' => 'Direktur One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 4,
                'username' => 'Direktur2',
                'nidn' => '19012912312121',
                'email' => 'Direktur2@gmail.com',
                'name' => 'Direktur Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 5,
                'username' => 'KJM',
                'nidn' => '19012912312121',
                'email' => 'KJM@gmail.com',
                'name' => 'KJM One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 5,
                'username' => 'KJM2',
                'nidn' => '19012912312121',
                'email' => 'KJM2@gmail.com',
                'name' => 'KJM Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 6,
                'username' => 'KPD',
                'nidn' => '19012912312121',
                'email' => 'KPD@gmail.com',
                'name' => 'KPD One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 6,
                'username' => 'KPD2',
                'nidn' => '19012912312121',
                'email' => 'KPD2@gmail.com',
                'name' => 'KPD Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 7,
                'username' => 'KJ',
                'nidn' => '19012912312121',
                'email' => 'KJ@gmail.com',
                'name' => 'KJ One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 7,
                'username' => 'KJ2',
                'nidn' => '19012912312122',
                'email' => 'KJ2@gmail.com',
                'name' => 'KJ Two',
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
