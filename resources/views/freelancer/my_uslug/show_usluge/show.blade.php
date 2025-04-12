@extends('layout.app')

@section('title-block', $service->title)

@section('main_content')
<div class="service-detail-container">
    <h1 class="service-title">{{ $service->title }}</h1>

    {{-- Информация о фрилансере --}}
    <div class="freelancer-info">
        <div class="freelancer-photo-name">
            <img src="{{ asset('resources/uploads/' . $service->user->profile_foto) }}" alt="Фото фрилансера" class="freelancer-avatar">
            <div>
                <h3>{{ $service->user->name }}</h3>
                <p class="freelancer-bio">{{ $service->user->bio }}</p>
                <span class="freelancer-role">{{ ucfirst($service->user->role) }}</span>
                <p class="freelancer-registered">Зарегистрирован: {{ $service->user->created_at->format('d.m.Y') }}</p>
            </div>
        </div>

        <div class="freelancer-stats">
            <p>📌 Услуг всего: {{ $service->user->services->count() }}</p>
            <p>❤️ Лайков: {{ $service->likes_count }}</p>
            <p>👀 Просмотров: {{ $service->views }}</p>
        </div>

        @if(auth()->id() !== $service->user->id)
            <a href="#" class="btn-contact">📨 Связаться с фрилансером</a>
        @endif
    </div>

    {{-- Примеры работ --}}
    @if($service->images)
        <div class="service-images">
            @foreach ($service->images as $img)
                <img src="{{ asset('storage/' . $img) }}" alt="Пример работы" class="work-preview">
            @endforeach
        </div>
    @endif

    {{-- Описание услуги --}}
    <div class="service-description">
        <h3>📋 Описание:</h3>
        <p>{{ $service->description }}</p>

        @if($service->long_description)
            <h4>🧾 Подробности:</h4>
            <p>{{ $service->long_description }}</p>
        @endif

        @if($service->url)
            <h4>🔗 Ссылка на пример работы:</h4>
            <p><a href="{{ $service->url }}" target="_blank">{{ $service->url }}</a></p>
        @endif

        <h3>💰 Стоимость: {{ $service->formatted_price }}</h3>
    </div>

    {{-- Отклик --}}
    @auth
        @if(auth()->id() !== $service->user->id)
            <div class="response-actions" style="margin-top: 25px;">
                <a href="{{ route('respond.to.freelancer', ['id' => $service->user->id]) }}" class="btn-respond">
                    🚀 Откликнуться на услугу
                </a>
            </div>
        @endif
    @endauth
</div>
@endsection