<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;      // Import Model News
use App\Models\Employee;  // Import Model Employee (ถ้ามี)

class DashboardController extends Controller
{
    /**
     * แสดงหน้า Dashboard หลักของ Admin
     */
    public function index()
    {
        // --- ส่วนนี้คือการดึงข้อมูลสรุป ---
        // ในโปรเจกต์จริง คุณสามารถดึงข้อมูลจากฐานข้อมูลได้โดยตรง
        $newsCount = News::count();
        // $employeeCount = Employee::count(); // ตัวอย่างการนับจำนวนพนักงาน

        // ส่งข้อมูลไปยัง View
        return view('admin.dashboard', [
            'newsCount' => $newsCount,
            'employeeCount' => 5, // ใช้ข้อมูลจำลองไปก่อน
        ]);
    }
}
