@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded" style="background-color:#ff69b4;">
    <h4 class="text-white mb-0">เพิ่มข่าวสาร</h4>

</div>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">หมวดหมู่ข่าวสาร</h3>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <a href="{{ route('admin.news.category', 'ประชาสัมพันธ์') }}" class="card category-card bg-primary text-white text-decoration-none">
            <div class="card-body text-center fw-bold">ประชาสัมพันธ์</div>
        </a>
    </div>
    <div class="col-md-3">

        <a href="{{ route('admin.news.category', 'งานวิจัย') }}" class="card category-card bg-danger text-white text-decoration-none">
            <div class="card-body text-center fw-bold">งานวิจัย</div>
        </a>
    </div>
    <div class="col-md-3">
        {{-- แก้ไข: เพิ่มพารามิเตอร์ 'บริการวิชาการ' เข้าไปใน route --}}
        <a href="{{ route('admin.news.category', 'บริการวิชาการ') }}" class="card category-card bg-primary text-white text-decoration-none">
            <div class="card-body text-center fw-bold">บริการวิชาการ</div>
        </a>
    </div>
    <div class="col-md-3">
        {{-- แก้ไข: เพิ่มพารามิเตอร์ 'นวัตกรรม' เข้าไปใน route --}}
        <a href="{{ route('admin.news.category', 'นวัตกรรม') }}" class="card category-card bg-success text-white text-decoration-none">
            <div class="card-body text-center fw-bold">นวัตกรรม</div>
        </a>
    </div>
    <div class="col-md-3">
        {{-- แก้ไข: เพิ่มพารามิเตอร์ 'กิจกรรม' เข้าไปใน route --}}
        <a href="{{ route('admin.news.category', 'กิจกรรม') }}" class="card category-card bg-fuchsia text-white text-decoration-none">
            <div class="card-body text-center fw-bold">กิจกรรม</div>
        </a>
    </div>
</div>
@endsection
