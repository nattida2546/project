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
            // 1. เพิ่มคอลัมน์สำหรับเก็บลิงก์เอกสาร
            $table->string('document_link')->nullable()->after('content');

            // 2. เพิ่มคอลัมน์สำหรับเก็บชุดรูปภาพกิจกรรม (เก็บเป็น JSON)
            $table->json('activity_images')->nullable()->after('document_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['document_link', 'activity_images']);
        });
    }
};
