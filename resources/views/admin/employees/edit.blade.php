@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded" style="background-color:#ff69b4;">
        <h4 class="text-white mb-0">แก้ไขข้อมูลพนักงาน</h4>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">แก้ไขข้อมูล: {{ $employee->firstname }} {{ $employee->lastname }}</h3>
                    </div>
                    {{-- action จะชี้ไปที่ route update พร้อมส่ง id ของ employee --}}
                    <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- ใช้ PUT method สำหรับการอัปเดต --}}
                        <div class="card-body">

                            {{-- ชื่อ-นามสกุล --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อจริง</label>
                                        {{-- ดึงข้อมูลเดิมมาแสดง --}}
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $employee->firstname) }}">
                                        @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>นามสกุล</label>
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $employee->lastname) }}">
                                        @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label>อีเมล (สำหรับเข้าระบบ)</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $employee->email) }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Role --}}
                            <div class="form-group">
                                <label>กำหนดสิทธิ์ (Role)</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="employee" {{ old('role', $employee->role) == 'employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="admin" {{ old('role', $employee->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- รหัสผ่าน --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสผ่านใหม่ (ถ้าต้องการเปลี่ยน)</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ยืนยันรหัสผ่านใหม่</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                            </div>

                            {{-- เบอร์โทร --}}
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $employee->phone) }}">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- แผนก --}}
                            <div class="form-group">
                                <label>ตำแหน่ง</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department', $employee->department) }}">
                                @error('department') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- วันที่เริ่มงาน --}}
                            <div class="form-group">
                                <label>วันที่เริ่มงาน</label>
                                <input type="date" class="form-control @error('hire_date') is-invalid @enderror" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}">
                                @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- รูปโปรไฟล์ --}}
                            <div class="form-group">
                                <label>รูปโปรไฟล์ใหม่ (ถ้าต้องการเปลี่ยน)</label>
                                <input type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image">
                                @error('profile_image') <span class="text-danger">{{ $message }}</span> @enderror
                                @if($employee->profile_image)
                                    <div class="mt-2">
                                        <small>รูปปัจจุบัน:</small><br>
                                        <img src="{{ asset('storage/' . $employee->profile_image) }}" height="100" class="img-thumbnail mt-1">
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">อัปเดตข้อมูล</button>
                            <a href="{{ route('admin.employees.index') }}" class="btn btn-danger">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
