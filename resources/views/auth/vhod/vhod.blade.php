@extends('layout.app')
@section('title-block')
Вход
@endsection

@section('main_content')
<main>
    <div class="cont-form">
        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf

            <h2>Войти</h2>

            @if ($errors->any())
                <div class="error-messages">
                    @foreach ($errors->all() as $error)
                        <p class="error-text">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <input type="email" class="input-field" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" class="input-field" name="password" placeholder="Пароль" required>

            <div class="policy-checkbox">
                <input type="checkbox" id="remember-me" name="remember_me">
                <label for="remember-me">Запомнить меня</label>
            </div>

            <button type="submit" class="submit-btn">Войти</button>

            <div class="already-account">
                <p>Нет аккаунта? <a href="{{ route('regist') }}">Зарегистрироваться</a></p>
            </div>
        </form>
    </div>
</main>
@endsection
