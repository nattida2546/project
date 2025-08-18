@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        
        <div class="card-header">
            <h2 class="mb-0">เพิ่มข่าวใหม่</h2>
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

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">หัวข้อข่าว</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-bold">ประเภทหลัก</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">-- กรุณาเลือกประเภทหลัก --</option>
                        @foreach ($categories as $mainCategory => $subcategories)
                            <option value="{{ $mainCategory }}" data-subcategories="{{ json_encode($subcategories) }}" {{ old('category', $selectedCategory) == $mainCategory ? 'selected' : '' }}>
                                {{ $mainCategory }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subcategory" class="form-label fw-bold">หมวดหมู่ย่อย</label>
                    <select class="form-select" id="subcategory" name="subcategory">
                        <option value="">-- เลือกหมวดหมู่ย่อย --</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">เนื้อหา</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">รูปภาพ (ถ้ามี)</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>

                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="javascript:history.back()" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');
    const oldSubcategory = "{{ old('subcategory') }}"; 

    function updateSubcategories() {
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        const subcategories = selectedOption.dataset.subcategories ? JSON.parse(selectedOption.dataset.subcategories) : [];

        subcategorySelect.innerHTML = '<option value="">-- เลือกหมวดหมู่ย่อย (ถ้ามี) --</option>';

        subcategories.forEach(function(subcategory) {
            const option = document.createElement('option');
            option.value = subcategory;
            option.textContent = subcategory;
           
            if (subcategory === oldSubcategory) {
                option.selected = true;
            }
            subcategorySelect.appendChild(option);
        });
    }

    categorySelect.addEventListener('change', updateSubcategories);
    updateSubcategories();
});
</script>
@endpush
