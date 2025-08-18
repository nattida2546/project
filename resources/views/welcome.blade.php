@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card-header" style="background-color:#ff69b4">
            <h4 class="text-white mb-0">เพิ่มข่าวใหม่</h4>
        
        </div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">แก้ไขข่าว: {{ $news->title }}</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">หัวข้อข่าว</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-bold">ประเภท</label>
                    <select class="form-select" id="category" name="category" required>
                        @foreach ($allCategories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $news->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">เนื้อหา</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">รูปภาพใหม่ (ถ้าต้องการเปลี่ยน)</label>
                    <input class="form-control" type="file" id="image" name="image">
                    @if($news->image)
                        <div class="mt-2">
                            <small>รูปปัจจุบัน:</small><br>
                            <img src="{{ asset('storage/' . $news->image) }}" height="100" class="img-thumbnail mt-1">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">อัปเดต</button>
                <a href="javascript:history.back()" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
@endsection
