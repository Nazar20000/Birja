<header>
    <div class="menu">
        <div class="logo">
            <a href="{{ route('home') }}"><img src="/resources/img/logo.png" alt="Error" class="logotip"></a>
        </div>

        <nav class="navigation">

            <a class="men" href="{{ route('usluge') }}">Мои услуги</a>
            <a class="men" href="../zakaz/zakaz.php">Заказы</a>
            <a class="men" href="../birja/birja.php">Биржа</a>
            <a class="men" href="../balanc/balanc.php">Баланс</a>
            <a class="men" href="../message/message.php">Чат</a>
        </nav>

        <div class="auth">
            <a class="men" href="../auth/vhod.php">
                @php
                    $many = Auth::user()->many ?? 0; // Если many равно null, установим 0
                @endphp
                {{ $many }}$
            </a>

            <div class="user-menu">
                <a class="men" href="../setting/setting.php">
                    @if(Auth::user()->profile_foto)
                        <img src="/resources/uploads/{{ Auth::user()->profile_foto }}" alt="User Image" class="foto-user">
                    @else
                        <img src="/resources/img/3.jpg" alt="User Image" class="foto-user">
                    @endif
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('setting') }}">Настройки</a></li>
                    <li><a href="../balanc/balanc.php">Баланс</a></li>
                    <li><a href="../usluge/usluge.php">Мои услуги</a></li>
                    <li><a href="{{ route('lagout') }}">Выход</a></li>
                </ul>
            </div>


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
    <a class="men" href="../auth/vhod.php">
        @php
            $many = Auth::user()->many ?? 0; // Если many равно null, установим 0
        @endphp
        {{ $many }}$
    </a>

    <a class="men" href="../setting/setting.php">
        @if(Auth::user()->profile_foto)
            <img src="/resources/uploads/{{ Auth::user()->profile_foto }}" alt="User Image" class="foto-user">
        @else
            <img src="/resources/img/3.jpg" alt="User Image" class="foto-user">
        @endif

    </a>

    <a class="men" href="{{ route('usluge') }}">Мои услуги</a>
    <a class="men" href="">Заказы</a>
    <a class="men" href="birja.php">Биржа</a>
    <a class="men" href="">Чат</a>
    <a class="men" href="">Выход</a>
</div>