@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-pink rounded" style="background-color:#ff69b4;">
        <h4 class="text-white mb-0">เพิ่มข้อมูลพนักงาน</h4>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">กรอกข้อมูลพนักงานใหม่</h3>
                    </div>
                    <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            {{-- แสดงข้อความแจ้งเตือน --}}
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- ชื่อ-นามสกุล --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อจริง</label>
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}">
                                        @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>นามสกุล</label>
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}">
                                        @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label>อีเมล (สำหรับเข้าระบบ)</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Role --}}
                            <div class="form-group">
                                <label>กำหนดสิทธิ์ (Role)</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="employee" {{ old('role')=='employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- รหัสผ่าน --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสผ่าน</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ยืนยันรหัสผ่าน</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                            </div>

                            {{-- เบอร์โทร --}}
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- แผนก / ตำแหน่ง --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>แผนก</label>
                                        <input type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}">
                                        @error('department') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- วันที่เริ่มงาน --}}
                            <div class="form-group">
                                <label>วันที่เริ่มงาน</label>
                                <input type="date" class="form-control @error('hire_date') is-invalid @enderror" name="hire_date" value="{{ old('hire_date') }}">
                                @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- รูปโปรไฟล์ --}}
                            <div class="form-group">
                                <label>รูปโปรไฟล์</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('profile_image') is-invalid @enderror" name="profile_image" id="profile_image">
                                        <label class="custom-file-label" for="profile_image">เลือกไฟล์</label>
                                    </div>
                                </div>
                                @error('profile_image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                            <a href="{{ route('admin.employees.index') }}" class="btn btn-danger">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('.custom-file-input');
    if(fileInput) {
        fileInput.addEventListener('change', function(e){
            const fileName = e.target.files[0] ? e.target.files[0].name : 'เลือกไฟล์';
            const nextSibling = e.target.nextElementSibling;
            if(nextSibling) nextSibling.innerText = fileName;
        });
    }
});
</script>
@endpush
