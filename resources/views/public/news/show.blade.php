@extends('layouts.public')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                {{-- ... Title, Category, Post Date ... --}}

                <div class="text-center my-4">
                    <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded" alt="{{ $news->title }}">
                </div>

                <div class="news-content">
                    {!! nl2br(e($news->content)) !!}
                </div>

                {{-- เพิ่ม: แสดงแกลเลอรี่รูปภาพกิจกรรม --}}
                @if($news->activity_images)
                    <h4 class="mt-5">แกลเลอรี่ภาพกิจกรรม</h4>
                    <div class="row g-2">
                        @foreach($news->activity_images as $img)
                        <div class="col-md-4">
                            <a href="{{ asset('storage/' . $img) }}" data-toggle="lightbox" data-gallery="gallery">
                                <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded">
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif

                {{-- เพิ่ม: แสดงปุ่มดาวน์โหลดเอกสาร --}}
                @if($news->document_link)
                    <div class="text-center mt-4">
                        <a href="{{ $news->document_link }}" class="btn btn-primary" target="_blank">
                            <i class="fas fa-download me-2"></i> ดาวน์โหลดเอกสารแนบ
                        </a>
                    </div>
                @endif

                <hr class="my-4">

                <div class="text-end text-muted">
                    <p class="mb-0"><strong>ผู้เขียน:</strong> {{ $news->employee->firstname ?? 'N/A' }} {{ $news->employee->lastname ?? '' }}</p>
                    <p class="mb-0"><strong>แผนก:</strong> {{ $news->employee->department ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('public.news.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> กลับไปหน้ารวมข่าว
            </a>
        </div>
    </div>
</div>
@endsection
