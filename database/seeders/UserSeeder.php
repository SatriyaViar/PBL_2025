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
        // Menambahkan beberapa data contoh untuk tabel m_users
        DB::table('m_user')->insert([
            [
                'level_id' => 1, // Pastikan ini sesuai dengan level_id yang ada di m_levels
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'name' => 'Admin User',
                'password' => Hash::make('12345678'), // Password yang sudah di-hash
            ],
            [
                'level_id' => 2,
                'username' => 'johndoe',
                'email' => 'johndoe@gmail.com',
                'name' => 'John Doe',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 2,
                'username' => 'jane_smith',
                'email' => 'jane_smith@gmail.com',
                'name' => 'Jane Smith',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 3,
                'username' => 'koordinator',
                'email' => 'koordinator@gmail.com',
                'name' => 'Koordinator One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 3,
                'username' => 'koordinator2',
                'email' => 'koordinator2@gmail.com',
                'name' => 'Koordinator Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 4,
                'username' => 'Direktur',
                'email' => 'Direktur@gmail.com',
                'name' => 'Direktur One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 4,
                'username' => 'Direktur2',
                'email' => 'Direktur2@gmail.com',
                'name' => 'Direktur Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 5,
                'username' => 'KJM',
                'email' => 'KJM@gmail.com',
                'name' => 'KJM One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 5,
                'username' => 'KJM2',
                'email' => 'KJM2@gmail.com',
                'name' => 'KJM Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 6,
                'username' => 'KPD',
                'email' => 'KPD@gmail.com',
                'name' => 'KPD One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 6,
                'username' => 'KPD2',
                'email' => 'KPD2@gmail.com',
                'name' => 'KPD Two',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 7,
                'username' => 'KJ',
                'email' => 'KJ@gmail.com',
                'name' => 'KJ One',
                'password' => Hash::make('12345678'),
            ],
            [
                'level_id' => 7,
                'username' => 'KJ2',
                'email' => 'KJ2@gmail.com',
                'name' => 'KJ Two',
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}