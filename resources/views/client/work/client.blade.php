@extends('layout.app')

@section('title-block', 'Исполнители')

@section('main_content')
<div class="services-container">
    <h1 class="services-title">Исполнители</h1>

    <div class="services-grid">
        @foreach ($services as $service)
            <div class="service-item">

                {{-- Фото услуги --}}
                @if($service->images && count($service->images) > 0)
                    <img src="{{ asset('storage/' . $service->images[0]) }}" class="service-image" alt="Изображение">
                @endif

                {{-- Название услуги --}}
                <h3 class="service-name">{{ $service->title }}</h3>

                {{-- Имя фрилансера --}}
                <p class="service-author">👤 {{ $service->user->name }}</p>

                {{-- Краткое описание --}}
                <p class="service-description">{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>

                {{-- Цена --}}
                <p class="service-cost">💰 {{ $service->formatted_price }}</p>

                {{-- Лайки и просмотры --}}
                <div class="service-stats" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                    <div class="like-section">
                        <button class="like-btn" data-service-id="{{ $service->id }}">
                            ❤️ <span class="like-counter">{{ $service->likes_count }}</span>
                        </button>
                    </div>
                    <div class="views-count" style="color: #3498db; font-size: 0.95rem;">
                        👀 {{ $service->views }}
                    </div>
                </div>

                {{-- Кнопка Подробнее --}}
                <a href="{{ route('services.show', $service->id) }}" class="btn-show" style="margin-top: 10px; display: inline-block;">
                    Подробнее
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
