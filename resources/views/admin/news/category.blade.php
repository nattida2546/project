@extends('layouts.admin')

@section('content')
<style>
    .header-bar {
        background-color: #ff69b4; /* Pink */
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .header-bar h2 {
        margin: 0;
        font-size: 1.75rem;
    }
</style>

<div class="container-fluid">
    <div class="header-bar">
        <h2>ข่าวสาร : {{ $category }}</h2>
        <div>
            <a href="{{ route('admin.news.create', ['category' => $category]) }}" class="btn btn-success fw-bold">
                <i class="fas fa-plus"></i> เพิ่มข่าว
            </a>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary fw-bold">
                <i class="fas fa-arrow-left"></i> กลับไปหน้าหมวดหมู่
            </a>
        </div>
    </div>

    {{-- ฟอร์มค้นหา --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <i class="fas fa-search"></i> ค้นหาข่าวในหมวดหมู่นี้
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.category', $category) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="ค้นหาจากหัวข้อข่าว..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
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

    {{-- ตารางแสดงผลข่าว --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>รูป</th>
                            <th>หัวข้อข่าว</th>
                            <th>หมวดหมู่ย่อย</th>
                            <th>ผู้สร้าง</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($news->currentPage() - 1) * $news->perPage() }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="news image" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <img src="https://placehold.co/60x60/EFEFEF/AAAAAA?text=No+Img" alt="no image" class="rounded">
                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->subcategory ?? '-' }}</td>
                                <td>{{ $item->employee->firstname ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning text-dark">
                                        <i class="fas fa-edit"></i> แก้ไข
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> ลบ
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">ไม่พบข้อมูลข่าวสาร (หรือผลการค้นหา)</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
