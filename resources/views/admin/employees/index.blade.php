@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded" style="background-color:#ff69b4;">
    <h4 class="text-white mb-0">จัดการข้อมูลพนักงาน</h4>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-light text-dark fw-bold">+ เพิ่มพนักงาน</a>
</div>

{{-- ส่วนของการค้นหา --}}
<div class="card mb-4">
    <div class="card-header bg-light">
        <i class="fas fa-search"></i> ค้นหาพนักงาน
    </div>
    <div class="card-body">
        <form action="{{ route('admin.employees.index') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control" placeholder="ค้นหาจากชื่อ-นามสกุล..." value="{{ request('name') }}">
                </div>
                <div class="col-md-5">
                    <input type="text" name="department" class="form-control" placeholder="ค้นหาจากแผนก..." value="{{ request('department') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">ค้นหา</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ลำดับ</th>
                        <th>โปรไฟล์</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ข้อมูลติดต่อ</th>
                        <th>ตำแหน่ง</th>
                        <th>สิทธิ์</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration + ($employees->currentPage() - 1) * $employees->perPage() }}</td>
                        <td>
                            @if($employee->profile_image)
                                <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="Profile" width="50" class="rounded-circle" style="height: 50px; object-fit: cover;">
                            @else
                                <img src="https://placehold.co/50x50/EFEFEF/AAAAAA?text=No+Img" alt="no image" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $employee->firstname }} {{ $employee->lastname }}</td>
                        {{-- แก้ไข: จัดให้บล็อกข้อมูลอยู่กึ่งกลาง แต่ข้อความชิดซ้าย --}}
                        <td>
                            <div class="d-inline-block text-start">
                                <div><i class="fas fa-envelope fa-fw me-2 text-muted"></i>{{ $employee->email }}</div>
                                <div><i class="fas fa-phone fa-fw me-2 text-muted"></i>{{ $employee->phone ?? '-' }}</div>
                            </div>
                        </td>
                        <td>{{ $employee->department ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $employee->role == 'admin' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($employee->role) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('ต้องการลบพนักงานนี้หรือไม่?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">ไม่มีข้อมูลพนักงาน</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="d-flex justify-content-end mt-3">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
