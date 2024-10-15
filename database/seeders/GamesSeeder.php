<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Games; // นำเข้าโมเดล Game
use Faker\Factory as Faker; // นำเข้า Faker

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // สร้าง instance ของ Faker

        for ($i = 0; $i < 50; $i++) { // สร้างข้อมูล 50 แถว
            Games::create([
                'title' => $faker->sentence(3), // สร้างชื่อเกม
                'release_year' => $faker->year(), // สร้างปีที่ออกจำหน่าย
                'genre' => $faker->word(), // สร้างประเภทเกม
                'description' => $faker->paragraph(), // สร้างคำอธิบายเกม
            ]);
        }
    }
}
