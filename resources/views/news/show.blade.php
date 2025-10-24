@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3>{{ $item->title }}</h3>
            <p class="text-muted small mb-3">
                <i class="bi bi-calendar-event"></i> {{ $item->created_at->format('d/m/Y H:i') }}
            </p>

            @if ($item->image)
                <img src="{{ asset('img/photo4.jpg') }}" alt="Ảnh tin" class="img-fluid rounded mb-3">
            @endif

            <div>{!! nl2br(e($item->content)) !!}</div>
        </div>
    </div>
</div>
@endsection
