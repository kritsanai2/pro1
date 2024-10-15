<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    // ตั้งค่าให้ระบุฟิลด์ที่สามารถถูกทำการ mass assign ได้
    protected $fillable = [
        'title',
        'release_year',
        'genre',
        'description',
    ];
}
