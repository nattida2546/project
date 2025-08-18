@extends('layouts.public')

@section('content')
    <h1 class="mb-4">ข่าวสารหมวดหมู่: {{ $category }}</h1>
    <div class="row g-4">
        @forelse ($allNews as $news)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm news-card">
                    <a href="{{ route('public.news.show', $news->id) }}" class="text-decoration-none text-dark">
                        <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit(strip_tags($news->content), 100) }}
                            </p>
                        </div>
                        <div class="card-footer text-muted small">
                            โพสเมื่อ: {{ $news->created_at->format('d/m/Y') }}
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col">
                <p class="text-center">ยังไม่มีข่าวสารในหมวดหมู่นี้</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $allNews->links() }}
    </div>
@endsection
