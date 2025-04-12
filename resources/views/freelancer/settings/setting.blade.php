@extends('layout.app')
@section('title-block', 'Настройки профиля')

@section('main_content')
<div class="settings-wrapper">
    <h1 class="settings-title">Настройки профиля</h1>

    @if(session('success'))
        <div class="response-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="settings-form">
        @csrf @method('PUT')

        <div class="field-container">
            <label for="photoInput" class="field-label">Фото профиля:</label>
            <input type="file" id="photoInput" class="field-input" name="profile_foto" accept="image/*" onchange="previewImage(event)">

            @if($user->profile_foto)
                <img id="photoPreview" src="{{ asset('resources/uploads/' . $user->profile_foto) }}" alt="Предпросмотр" class="image-preview">
            @else
                <img id="photoPreview" src="" alt="Предпросмотр" class="image-preview">
            @endif
        </div>

        <div class="field-container">
            <label for="fullName" class="field-label">Имя:</label>
            <input type="text" id="fullName" name="name" class="field-input" required value="{{ $user->name }}">
        </div>

        <div class="field-container">
            <label for="userMail" class="field-label">Электронная почта:</label>
            <input type="email" id="userMail" name="email" class="field-input" required value="{{ $user->email }}">
        </div>

        <div class="field-container">
            <label for="aboutUser" class="field-label">Информация о себе:</label>
            <textarea id="aboutUser" name="bio" class="field-textarea" rows="4" required>{{ $user->bio }}</textarea>
        </div>

        <div class="field-container">
            <label for="userPass" class="field-label">Пароль (если хотите изменить):</label>
            <input type="password" id="userPass" name="password" class="field-input">
        </div>

        <div class="field-container">
            <label for="roleSelect" class="field-label">Роль:</label>
            <select id="roleSelect" name="role" class="field-input">
                <option value="freelancer" {{ $user->role == 'freelancer' ? 'selected' : '' }}>Фрилансер</option>
                <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Клиент</option>
            </select>
        </div>

        <button type="submit" class="btn-save-changes">Сохранить изменения</button>
    </form>
</div>
@endsection