@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">แก้ไขข่าว: {{ $news->title }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- ... Title, Category, Subcategory ... --}}

                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">เนื้อหา</label>
                    <textarea class="form-control" name="content" rows="5" required>{{ old('content', $news->content) }}</textarea>
                </div>

                {{-- เพิ่ม: ลิงก์เอกสาร --}}
                <div class="mb-3">
                    <label for="document_link" class="form-label fw-bold">ลิงก์เอกสาร (ถ้ามี)</label>
                    <input type="url" class="form-control" name="document_link" value="{{ old('document_link', $news->document_link) }}" placeholder="https://example.com/document.pdf">
                </div>

                <div class="row">
                    {{-- รูปภาพหลัก --}}
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label fw-bold">รูปภาพหลัก (ถ้าต้องการเปลี่ยน)</label>
                        <input class="form-control" type="file" name="image">
                        @if($news->image)
                            <div class="mt-2"><small>รูปปัจจุบัน:</small><br><img src="{{ asset('storage/' . $news->image) }}" style="height: 80px; width: auto;" class="img-thumbnail mt-1"></div>
                        @endif
                    </div>
                    {{-- เพิ่ม: รูปภาพกิจกรรม --}}
                    <div class="col-md-6 mb-3">
                        <label for="activity_images" class="form-label fw-bold">รูปภาพกิจกรรม (เลือกหลายรูปได้)</label>
                        <input class="form-control" type="file" name="activity_images[]" multiple>
                        @if($news->activity_images)
                            <div class="mt-2"><small>รูปกิจกรรมปัจจุบัน:</small><br>
                                @foreach($news->activity_images as $img)
                                <img src="{{ asset('storage/' . $img) }}" style="height: 50px; width: auto;" class="img-thumbnail mt-1">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">อัปเดตข้อมูล</button>
                <a href="{{ route('admin.news.category', $news->category) }}" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
@endsection
