@extends('layout.app')
@section('title-block')
Регистрация
@endsection

@section('main_content')
<main>
    <div class="cont-form">
       

        <form action="{{ route('regist-form') }}" novalidate method="post" class="register-form" enctype="multipart/form-data">
            @csrf

            <h2>Регистрация</h2>

            <!-- Имя -->
            <input type="text" placeholder="Имя" name="name" class="input-field" value="{{ old('name') }}" >
            @error('name')
            <p class="error-message">{{ $message }}</p> @enderror

            <!-- Email -->
            <input type="email" placeholder="Email" name="email" class="input-field" value="{{ old('email') }}"
                >
            @error('email')
            <p class="error-message">{{ $message }}</p> @enderror

            <!-- Пароль -->
            <input type="password" placeholder="Пароль" name="password" class="input-field" >
            @error('password')
            <p class="error-message">{{ $message }}</p> @enderror

            <!-- Подтверждение пароля -->
            <input type="password" placeholder="Подтвердите пароль" name="password_confirmation" class="input-field"
                >
            @error('password_confirmation')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <!-- Роль (Фрилансер или Заказчик) -->
            <label for="role" class="role-label">Выберите роль:</label>
            <div class="role-selection">
                <input type="radio" id="freelancer" name="role" value="freelancer" {{ old('role') == 'freelancer' ? 'checked' : '' }} class="radio-input" required>
                <label for="freelancer" class="radio-label">Фрилансер</label>

                <input type="radio" id="client" name="role" value="client" {{ old('role') == 'client' ? 'checked' : '' }}
                    class="radio-input" >
                <label for="client" class="radio-label">Заказчик</label>
            </div>
            @error('role')
            <p class="error-message">{{ $message }}</p> @enderror

            <!-- Загрузка изображения профиля -->
            <label for="profile_pic" class="upload-label">Загрузить изображение профиля:</label>
            <input type="file" id="profile_pic" name="profile_foto" accept="image/*" class="upload-input">
            @error('profile_foto')
            <p class="error-message">{{ $message }}</p> @enderror

            <!-- Согласие с политикой конфиденциальности -->
            <div class="policy-checkbox">
                <input type="checkbox" id="agree_policy" name="agree_policy" {{ old('agree_policy') ? 'checked' : '' }}
                    >
                <label for="agree_policy" class="policy-label">Я согласен с <a href="#">политикой
                        конфиденциальности</a></label>
            </div>
            @error('agree_policy')
            <p class="error-message">{{ $message }}</p> @enderror

            <!-- Кнопка регистрации -->
            <button type="submit" class="submit-btn">Зарегистрироваться</button>

            <!-- Если есть аккаунт -->
            <p class="already-account">Уже есть аккаунт? <a href="{{ route('vhod') }}">Войти</a></p>
        </form>
    </div>
</main>


@endsection