@extends('layout.app')

@section('title-block', 'Мои услуги')

@section('main_content')
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

                    {{-- Фото услуги --}}
                    @if($service->images && count($service->images) > 0)
                        <img src="{{ asset('storage/' . $service->images[0]) }}" alt="Изображение услуги" style="max-width: 100%; max-height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                    @endif

                    {{-- Имя фрилансера --}}
                    <p class="service-author" style="margin-bottom: 5px;"><strong>👤 Исполнитель:</strong> {{ $service->user->name }}</p>

                    {{-- Заголовок услуги --}}
                    <h3 class="service-name" style="margin-bottom: 10px;"><strong>🔹 Название услуги:</strong><br> {{ $service->title }}</h3>

                    {{-- Краткое описание --}}
                    <p class="service-details"><strong>📋 Описание:</strong><br>{{ $service->description }}</p>

                    {{-- Подробное описание --}}
                    @if($service->long_description)
                        <p class="service-long"><strong>🧾 Подробности:</strong><br>{{ $service->long_description }}</p>
                    @endif

                    {{-- Ссылка на портфолио или пример --}}
                    @if($service->url)
                        <p style="margin-bottom: 10px; font-size: 0.95rem;">
                            <strong>🔗 Пример работы:</strong>
                            <a href="{{ $service->url }}" target="_blank">{{ $service->url }}</a>
                        </p>
                    @endif

                    {{-- Цена --}}
                    <p class="service-cost"><strong>💰 Стоимость:</strong> {{ $service->formatted_price }}</p>

                    {{-- Кнопки управления --}}
                    <div class="service-buttons">
                        <a href="{{ route('services.edit', $service->id) }}" class="btn-edit">✏️ Редактировать</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-delete">🗑️ Удалить</button>
                        </form>
                    </div>

                    {{-- Лайки и просмотры --}}
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
                </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
