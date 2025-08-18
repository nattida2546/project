<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\Dean\DashboardController as DeanDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Routes สำหรับผู้ใช้งานทั่วไป (Public) ---
Route::get('/', [PublicNewsController::class, 'index'])->name('public.news.index');
Route::get('/news/{news}', [PublicNewsController::class, 'show'])->name('public.news.show');
Route::get('/category/{category}', [PublicNewsController::class, 'showCategory'])->name('public.news.category');


// --- Routes สำหรับส่วนของ Admin ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

   
    Route::get('news', [AdminNewsController::class, 'index'])->name('news.index');
    Route::get('news/category/{category}', [AdminNewsController::class, 'category'])->name('news.category');
    Route::get('news/create/{category?}', [AdminNewsController::class, 'create'])->name('news.create');

    
    Route::get('news/{news}/data', [AdminNewsController::class, 'getNewsData'])->name('news.data');

    Route::resource('news', AdminNewsController::class)->except(['index', 'show', 'create']);
    
 
    Route::resource('employees', EmployeeController::class);
});

Route::get('/dashboard', [DeanDashboardController::class, 'index'])->name('dashboard');