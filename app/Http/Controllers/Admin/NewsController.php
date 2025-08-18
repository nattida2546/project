<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // ... ฟังก์ชันอื่นๆ เหมือนเดิม ...

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'document_link' => 'nullable|url', // ตรวจสอบว่าเป็น URL ที่ถูกต้อง
            'image' => 'nullable|image',
            'activity_images.*' => 'nullable|image', // ตรวจสอบไฟล์ทุกไฟล์ใน array
        ]);

        $data = $request->all();
        $data['employee_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        // จัดการการอัปโหลดรูปภาพกิจกรรม (หลายไฟล์)
        if ($request->hasFile('activity_images')) {
            $paths = [];
            foreach ($request->file('activity_images') as $file) {
                $paths[] = $file->store('news_activity_images', 'public');
            }
            $data['activity_images'] = $paths;
        }

        News::create($data);

        return redirect()->route('admin.news.category', ['category' => $request->category])
                         ->with('success', 'เพิ่มข่าวสำเร็จ');
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'document_link' => 'nullable|url',
            'image' => 'nullable|image',
            'activity_images.*' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($news->image) Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        // จัดการการอัปโหลดรูปภาพกิจกรรม (ถ้ามีการอัปโหลดใหม่)
        if ($request->hasFile('activity_images')) {
            // ลบรูปกิจกรรมเก่าทั้งหมด (ถ้ามี)
            if ($news->activity_images) {
                foreach ($news->activity_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $paths = [];
            foreach ($request->file('activity_images') as $file) {
                $paths[] = $file->store('news_activity_images', 'public');
            }
            $data['activity_images'] = $paths;
        }

        $news->update($data);

        return redirect()->route('admin.news.category', ['category' => $news->category])
                         ->with('success', 'อัปเดตข่าวสำเร็จ');
    }
    
    // ... ฟังก์ชันอื่นๆ ...
}
