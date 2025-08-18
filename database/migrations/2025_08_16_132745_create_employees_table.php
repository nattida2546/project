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
         Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('role')->default('employee'); // เพิ่ม: สถานะ
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('department')->nullable(); // เพิ่ม: แผนก/ตำแหน่ง
            $table->date('hire_date')->nullable(); // เพิ่ม: วันที่เริ่มงาน
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
