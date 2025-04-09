<header>
        <div class="menu">
            <div class="logo">
                <a href="{{ route('home') }}"><img src="/resources/img/logo.png" alt="Error" class="logotip"></a>
            </div>
            <nav class="navigation">
                <a class="men" href="{{ route('home') }}">Главная</a>
                <a class="men" href="{{ route('birja') }}">Биржа</a>
                <a class="men" href="#">О нас</a>
                <a class="men" href="#">Контакты</a>
            </nav>
            <div class="auth">
                <a class="men" href="{{ route('vhod') }}">Войти</a>
                <a class="men" href="{{ route('regist') }}">Регистрация</a>
            </div>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

    </header>

    <button id="theme-toggle" class="theme-toggle">
        <span id="theme-icon">🌙</span>
    </button>


    <div class="mobile-menu">
        <a class="men" href="{{ route('home') }}">Главная</a>
        <a class="men" href="{{ route('birja') }}">Биржа</a>
        <a class="men" href="#">О нас</a>
        <a class="men" href="#">Контакты</a>
        <a class="men" href="{{ route('vhod') }}">Войти</a>
        <a class="men" href="{{ route('regist') }}">Регистрация</a>
    </div>
