@extends('layout.app')

@section('title-block', 'Мои услуги')

@section('main_content')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">

<div class="services-container">
    <div class="services-header">
        <h1 class="services-title">Мои услуги</h1>
        <a href="{{ route('services.create') }}" class="btn-add">➕ Добавить услугу</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="services-filter">
        <input type="text" name="search" placeholder="Поиск услуг..." value="{{ request('search') }}" class="form-control">
        <select name="sort" class="form-control">
            <option value="">Сортировка по цене</option>
            <option value="price_asc">Сначала дешевые</option>
            <option value="price_desc">Сначала дорогие</option>
        </select>
        <button type="submit" class="btn-add">Фильтровать</button>
    </form>

    @if ($services->isEmpty())
        <p class="text-center mt-4">Вы еще не добавили ни одной услуги.</p>
    @else
        <div class="services-grid">
            @foreach ($services as $service)
            <div class="service-item">
                <div class="service-preview">
                    {{-- Фото услуги --}}
                    @if($service->images && count($service->images) > 0)
                        <img src="{{ asset('storage/' . $service->images[0]) }}" alt="Изображение услуги" class="service-image">
                    @endif
                </div>
                <div class="service-details-block">
                    <h3 class="service-name">🔹 {{ $service->title }}</h3>
                    <p class="service-author">👤 {{ $service->user->name }}</p>
                    <p class="service-description">📋 {{ $service->description }}</p>
                    @if($service->long_description)
                        <p class="service-long">🧾 {{ $service->long_description }}</p>
                    @endif
                    @if($service->url)
                        <p class="service-url">🔗 <a href="{{ $service->url }}" target="_blank" style="color: #58a6ff">{{ $service->url }}</a></p>
                    @endif
                    <p class="service-cost">💰 {{ $service->formatted_price }}</p>
                    <div class="container-reaction">
                        <div class="like-section">
                            <button class="like-btn" data-service-id="{{ $service->id }}">
                                ❤️ <span class="like-counter">{{ $service->likes_count }}</span>
                            </button>
                        </div>
                        <div class="See-section">
                            <div class="See-btn" data-service-id="{{ $service->id }}">
                                👀 <span class="See-counter">{{ $service->views }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-actions">
                        <a href="{{ route('services.edit', $service->id) }}" class="btn-edit">✏️ Редактировать</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-delete">🗑️ Удалить</button>
                        </form>
                        <a href="{{ route('services.show', $service->id) }}" class="btn-show">📄 Подробнее</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-container">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
