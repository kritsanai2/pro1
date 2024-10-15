<?php

namespace App\Http\Controllers;

use App\Models\Games; // ใช้โมเดล Game
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // คืนค่ารายการเกมทั้งหมด
        return Games::all(); // หรือสามารถใช้ GameResource ถ้าคุณมี Resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'release_year' => 'required|integer|min:0|max:' . date('Y'), // ใช้ integer ที่นี่
                'genre' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            // สร้างเกมใหม่
            $game = Games::create($validatedData);

            // ส่งการตอบกลับ JSON พร้อมข้อมูลเกมใหม่
            return response()->json($game, 201);
        } catch (\Exception $e) {
            // บันทึกข้อผิดพลาดลงใน log
            Log::error($e->getMessage());

            // ส่งการตอบกลับ JSON พร้อมรายละเอียดข้อผิดพลาด
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $game = Games::find($id);
        
        // ตรวจสอบว่าเกมมีอยู่หรือไม่
        if (!$game) {
            return response()->json(['error' => 'Game not found.'], 404);
        }

        return response()->json($game);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // ค้นหาเกมตามไอดี
            $game = Games::findOrFail($id);

            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'release_year' => 'required|integer|min:0|max:' . date('Y'), // ใช้ integer ที่นี่
                'genre' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            // อัปเดตข้อมูลของเกม
            $game->update($validatedData);

            // ส่งการตอบกลับ JSON พร้อมข้อมูลเกมใหม่
            return response()->json($game, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            // แสดงข้อความข้อผิดพลาดจากฐานข้อมูล
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // แสดงข้อความข้อผิดพลาดทั่วไป
            return response()->json(['error' => 'มีบางอย่างผิดพลาดในกระบวนการอัปเดตข้อมูล'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // ค้นหาเกมในฐานข้อมูล
        $game = Games::find($id);

        // ตรวจสอบว่าเกมมีอยู่หรือไม่
        if (!$game) {
            return response()->json(['error' => 'Game not found.'], 404);
        }

        // ลบเกม
        $game->delete();

        // ส่งการตอบกลับ JSON พร้อมข้อความสำเร็จ
        return response()->json(['success' => 'ลบเกมเรียบร้อยแล้ว.'], 200);
    }
}
