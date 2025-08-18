@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">รายงานภาพรวม</h3>

    <div class="row g-4">
        {{-- Card: จำนวนข่าวทั้งหมด --}}
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">ข่าวทั้งหมด</h5>
                        <p class="card-text fs-1 fw-bold">{{ $newsCount }}</p>
                    </div>
                    <i class="fas fa-newspaper fa-3x opacity-50"></i>
                </div>
                <a href="{{ route('admin.news.index') }}" class="card-footer text-white text-decoration-none">
                    ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card: จำนวนเจ้าหน้าที่ --}}
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">เจ้าหน้าที่</h5>
                        <p class="card-text fs-1 fw-bold">{{ $employeeCount }}</p>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
                <a href="{{ route('admin.employees.index') }}" class="card-footer text-white text-decoration-none">
                    ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card: ตัวอย่างอื่นๆ --}}
        <div class="col-md-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">ยอดเข้าชม (วันนี้)</h5>
                        <p class="card-text fs-1 fw-bold">1,234</p>
                    </div>
                    <i class="fas fa-eye fa-3x opacity-50"></i>
                </div>
                <a href="#" class="card-footer text-white text-decoration-none">
                    ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- คุณสามารถเพิ่มส่วนอื่นๆ ของ Dashboard ได้ที่นี่ เช่น กราฟ หรือ ตารางข้อมูลล่าสุด --}}

</div>
@endsection
