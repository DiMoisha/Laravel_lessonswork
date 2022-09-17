<!doctype html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="/" />
    <meta name="description" content="Агрегатор новостей. Новостной портал.">
    <meta name="author" content="Dmitrii Karasev and Bootstrap 5">
    <meta name="docsearch:language" content="ru">
    <meta name="docsearch:version" content="5.0">
    <title>Агрегатор новостей. Новостной портал</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="{{ asset('css/docs.css') }}">--}}
    <!-- Favicons -->
{{--    <link rel="apple-touch-icon" href="https://bootstrap5.ru/img/favicons/apple-touch-icon.png" sizes="180x180">--}}
    <link rel="icon" href="{{ asset('img/favicon-32x32.png')}}" sizes="32x32" type="image/png">
{{--    <link rel="icon" href="img/favicon-16x16.png" sizes="16x16" type="image/png">--}}
{{--    <link rel="manifest" href="https://bootstrap5.ru/img/favicons/manifest.json">--}}
{{--    <link rel="mask-icon" href="https://bootstrap5.ru/img/favicons/safari-pinned-tab.svg" color="#7952b3">--}}
    <link rel="icon" href="{{ asset('img/favicon.ico')}}">
    <meta name="theme-color" content="#7952b3">
    <!-- Facebook -->
    <meta property="og:url" content="/">
    <meta property="og:title" content="Агрегатор новостей. Новостной портал">
    <meta property="og:description" content="Агрегатор новостей. Новостной портал">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://bootstrap5.ru/img/examples/blog.png">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="1000">
    <meta property="og:image:height" content="500">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <x-header></x-header>
    @isset($categories)
        @if (isset($categoryId))
            <x-category_menu :categories="$categories" :categoryId="$categoryId"></x-category_menu>
        @else
            <x-category_menu :categories="$categories"></x-category_menu>
        @endif
    @endisset
    @if (isset($isHomeIndexPage) && isset($pageTitle))
        <x-home_index_header :pageTitle="$pageTitle"></x-home_index_header>
    @endif
</div>
<main class="container">
    @if (!isset($isHomeIndexPage) && isset($pageTitle))
        <x-page_title :pageTitle="$pageTitle"></x-page_title>
    @endif
    @yield('content')
</main>
<x-footer></x-footer>
</body>
</html>
