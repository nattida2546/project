<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News; // อย่าลืม import Model News

class DashboardController extends Controller
{
    /**
     * แสดงหน้า Dashboard หลักสำหรับคณบดี
     */
    public function index()
    {
        // 1. นับจำนวนข่าวทั้งหมดในระบบ
        $newsCount = News::count();

        // 2. ดึงข่าว 5 ชิ้นล่าสุด พร้อมกับข้อมูลผู้เขียน (employee)
        //    ใช้ with('employee') เพื่อประสิทธิภาพในการดึงข้อมูล
        $latestNews = News::with('employee')->latest()->take(5)->get();

        // 3. ส่งข้อมูลทั้งหมดไปยัง View
        return view('dean.dashboard.index', compact('newsCount', 'latestNews'));
    }
}
