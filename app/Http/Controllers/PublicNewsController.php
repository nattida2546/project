<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class PublicNewsController extends Controller
{
    /**
     * แสดงหน้ารวมข่าวสำหรับผู้ใช้ทั่วไป
     */
    public function index()
    {
        // กำหนดหมวดหมู่ทั้งหมดที่ต้องการแสดงในหน้าแรก
        $categoriesToShow = [
            'ประชาสัมพันธ์',
            'งานวิจัย',
            'บริการวิชาการ',
            'นวัตกรรม',
            'กิจกรรม'
        ];

        $newsByCategory = [];

        // วนลูปเพื่อดึงข่าวล่าสุด 3 ชิ้นจากแต่ละหมวดหมู่
        foreach ($categoriesToShow as $category) {
            $newsByCategory[$category] = News::where('category', $category)
                                             ->latest()
                                             ->take(3)
                                             ->get();
        }

        // ส่งตัวแปร $newsByCategory ไปยัง view
        return view('public.news.index', compact('newsByCategory'));
    }

    /**
     * แสดงรายละเอียดข่าว 1 ชิ้น
     */
    public function show(News $news)
    {
        return view('public.news.show', compact('news'));
    }

    /**
     * แสดงข่าวทั้งหมดในหมวดหมู่ที่เลือก
     */
    public function showCategory($category)
    {
        $allNews = News::with('employee')
                       ->where('category', $category)
                       ->latest()
                       ->paginate(9);

        return view('public.news.category', compact('allNews', 'category'));
    }
}
