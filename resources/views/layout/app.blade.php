<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/menu/menu.css">
    <link rel="stylesheet" href="/css/menu/menu_button.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/fon.css">

    <link rel="stylesheet" href="/css/index/index_main.css">
    <link rel="stylesheet" href="/css/footer/footer.css">
    <link rel="stylesheet" href="/css/regist/regist.css">
    <link rel="stylesheet" href="/css/vhod/vhod.css">

    <link rel="stylesheet" href="/css/usluge/uslug.css">
    <link rel="stylesheet" href="/css/usluge/add.css">
    <link rel="stylesheet" href="/css/usluge/show.css">
    <link rel="stylesheet" href="/css/usluge/create_usluge.css">

    <link rel="stylesheet" href="/css/setting_profile/setting.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title-block')</title>
</head>

<body>

@if (Auth::check())
    @if (Auth::user()->role === 'client')
        @include('inc.header_client') <!-- Меню для клиента -->
    @elseif (Auth::user()->role === 'freelancer')
        @include('inc.header_freelancer') <!-- Меню для фрилансера -->
    @else
        @include('inc.header_index') <!-- Меню по умолчанию -->
    @endif
@else
    @include('inc.header_index') <!-- Меню для гостей -->
@endif


    @yield('main_content')

    @include('inc.footer')


    <script src="/js/menu.js"></script>
    <script src="/js/menu_button.js"></script>
    <script src="/js/setting.js"></script>
    <script src="/js/like.js"></script>
    <script src="/js/fon.js"></script>
</body>

</html>