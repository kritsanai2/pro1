<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // ตรวจสอบการล็อกอิน
        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            // สร้าง token สำหรับผู้ใช้
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'ล็อกอินสำเร็จ',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json(['error' => 'ข้อมูลล็อกอินไม่ถูกต้อง'], 401);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'ล็อกเอาท์สำเร็จ',
        ], 200);
    }
}
