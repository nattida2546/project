@extends('layouts.public')

@section('content')
    {{-- Hero Banner --}}
    <div class="text-center mb-5">
        <img src="https://i.imgur.com/KxL8g4T.png" class="img-fluid rounded" alt="Adtech Community Banner">
    </div>

    {{-- วนลูปแสดงข่าวตามหมวดหมู่ทั้งหมด --}}
    @foreach ($newsByCategory as $category => $newsItems)
        {{-- ตรวจสอบว่าหมวดหมู่นั้นมีข่าวหรือไม่ก่อนแสดงผล --}}
        @if($newsItems->isNotEmpty())
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3 pb-2">
                    <h2 class="h5 fw-bold text-danger mb-0"><i class="fas fa-bullhorn"></i> {{ $category }}</h2>
                    <a href="{{ route('public.news.category', $category) }}" class="text-muted text-decoration-none small">ดูทั้งหมด <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="row g-4">
                    @foreach ($newsItems as $news)
                    <div class="col-md-4">
                        <a href="{{ route('public.news.show', $news->id) }}" class="text-decoration-none text-dark">
                            <div class="news-card-sm p-2">
                                <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded mb-2" alt="{{ $news->title }}">
                                <p class="mb-0 fw-bold">{{ $news->title }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach
@endsection
