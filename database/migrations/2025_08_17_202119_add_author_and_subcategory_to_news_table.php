<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // 1. เพิ่มคอลัมน์สำหรับหมวดหมู่ย่อย
            $table->string('subcategory')->nullable()->after('category');

            // 2. เพิ่มคอลัมน์สำหรับเชื่อมโยงไปยังผู้สร้าง (employee)
            // onDelete('set null') หมายถึง ถ้าพนักงานคนนั้นถูกลบ โพสข่าวจะยังอยู่ แต่จะไม่มีข้อมูลผู้สร้าง
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null')->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn(['subcategory', 'employee_id']);
        });
    }
};
