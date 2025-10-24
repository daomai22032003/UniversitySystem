@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">

        <!-- Tin tức chính -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-newspaper me-2"></i>
                    <h5 class="mb-0">TIN TỨC MỚI NHẤT</h5>
                </div>
                <div class="card-body">
                   
                    @foreach ($news as $item)
                    <div class="row mb-4 border-bottom pb-3">
                        <div class="col-md-4">
                            <img src="https://humg.edu.vn/content/tintuc/PublishingImages/SuKien/2024/img_6109.jpg" 
                             alt="Ảnh tin" 
                            class="img-fluid rounded">


                        </div>
                        <div class="col-md-8">
                            <h6 class="fw-bold">
                                <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none text-dark">
                                    {{ $item->title }}
                                </a>
                            </h6>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-calendar-event"></i> {{ $item->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="text-secondary small mb-0">
                                {{ Str::limit($item->summary, 100) }}
                            </p>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-3">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar thông báo -->
        <div class="col-lg-4">
            @include('partials.announcements')
        </div>

    </div>
</div>
@endsection
