<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // นำเข้าโมเดล User
use Illuminate\Support\Facades\Hash; // นำเข้า Hash สำหรับเข้ารหัสรหัสผ่าน
use Faker\Factory as Faker; // นำเข้า Faker

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // สร้าง instance ของ Faker

        // สร้างผู้ใช้ 10 คน
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name(), // สร้างชื่อ
                'email' => $faker->unique()->safeEmail(), // สร้างอีเมลที่ไม่ซ้ำกัน
                'password' => Hash::make('password'), // เข้ารหัสรหัสผ่านเป็น 'password'
                'created_at' => now(), // วันที่และเวลาที่สร้าง
                'updated_at' => now(), // วันที่และเวลาที่แก้ไขล่าสุด
            ]);
        }
    }
}
