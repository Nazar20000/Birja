@extends('layout.app')

@section('title-block', 'Отклик на услугу')

@section('main_content')
<div class="respond-container" style="max-width: 800px; margin: 30px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px;">Связаться с фрилансером: <strong>{{ $freelancer->name }}</strong></h2>

    <p><strong>📋 Описание профиля:</strong><br>{{ $freelancer->bio }}</p>
    <p><strong>👤 Роль:</strong> {{ ucfirst($freelancer->role) }}</p>
    <p><strong>📅 На сайте с:</strong> {{ $freelancer->created_at->format('d.m.Y') }}</p>

    <hr>

    <h3>🛠️ Услуги фрилансера:</h3>
    <ul>
        @foreach($freelancer->services as $service)
            <li>
                <strong>{{ $service->title }}</strong> — {{ $service->formatted_price }}
                <br>
                <a href="{{ route('services.show', $service->id) }}">Посмотреть</a>
            </li>
        @endforeach
    </ul>

    <hr>

    <a href="#" class="btn-contact" style="margin-top: 20px; display: inline-block; padding: 10px 20px; background-color: #34a853; color: white; border-radius: 8px; text-decoration: none;">📨 Написать сообщение</a>
</div>
@endsection
