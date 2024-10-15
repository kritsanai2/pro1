<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder; // นำเข้า UserSeeder
use Database\Seeders\GamesSeeder; // นำเข้า MovieSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // เรียกใช้ UserSeeder เพื่อเพิ่มข้อมูลในตาราง users
        $this->call(UserSeeder::class);
        
        // เรียกใช้ MovieSeeder เพื่อเพิ่มข้อมูลในตาราง movies
        $this->call(GamesSeeder::class);
    }
}
