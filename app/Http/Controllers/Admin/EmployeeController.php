<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // เพิ่ม DB Facade

class EmployeeController extends Controller
{
    /**
     * แสดงรายการพนักงานทั้งหมด (พร้อมระบบค้นหา)
     */
    public function index(Request $request)
    {
        // เริ่มต้น Query Builder
        $query = Employee::query();

        // แก้ไข: ตรวจสอบและกรองข้อมูลตาม 'name'
        if ($request->filled('name')) {
            $name = $request->input('name');
            // ค้นหาจากชื่อเต็ม (firstname + ' ' + lastname)
            $query->where(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', "%{$name}%");
        }

        // ตรวจสอบและกรองข้อมูลตาม 'department'
        if ($request->filled('department')) {
            $department = $request->input('department');
            $query->where('department', 'like', "%{$department}%");
        }

        // ดึงข้อมูลล่าสุดและแบ่งหน้า
        $employees = $query->latest()->paginate(10);

        // ส่งค่าที่ค้นหาไปด้วยเพื่อให้ pagination links ทำงานถูกต้อง
        $employees->appends($request->all());

        return view('admin.employees.index', compact('employees'));
    }

    // ... ฟังก์ชัน create, store, edit, update, destroy เหมือนเดิม ...

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'role' => 'required|string|in:employee,admin',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('employee_profiles', 'public');
            $data['profile_image'] = $path;
        }

        Employee::create($data);
        return redirect()->route('admin.employees.index')->with('success', 'เพิ่มข้อมูลพนักงานสำเร็จ');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
            'role' => 'required|string|in:employee,admin',
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            if ($employee->profile_image) {
                Storage::disk('public')->delete($employee->profile_image);
            }
            $path = $request->file('profile_image')->store('employee_profiles', 'public');
            $data['profile_image'] = $path;
        }

        $employee->update($data);
        return redirect()->route('admin.employees.index')->with('success', 'อัปเดตข้อมูลพนักงานสำเร็จ');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->profile_image) {
            Storage::disk('public')->delete($employee->profile_image);
        }
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'ลบพนักงานสำเร็จ');
    }
}
