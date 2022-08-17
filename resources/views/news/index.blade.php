@extends('layouts.main')
{{--@section('title') Список новостей @parent @endsection--}}
@section('content')
    <div class="row mb-2">
        @forelse($newsList as $key => $news)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">{{$categoryTitle}}</strong>
                        <h2 class="mb-0">{{$news['title']}}</h2>
                        <div class="mb-1 text-muted">{{$news['author']}} - {{$news['created_at']->format('d-m-Y H:i')}}</div>
                        <p class="card-text mb-auto">{{$news['description']}}</p>
                        <a href="{{route('news.show', ['id' => $news['newsId']])}}" class="stretched-link">Перейти к новости</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                             aria-label="Placeholder: HotNews: {{$categoryTitle}}" preserveaspectratio="xMidYMid slice" role="img"
                             focusable="false">
                            <title>HotNews:&nbsp;{{$categoryTitle}}</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">HotNews:&nbsp;{{$categoryTitle}}</text>
                        </svg>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 bg-warning">
                <h2 class="text-warning text-center">В этой категории пока новостей нет!</h2>
            </div>
        @endforelse
        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="{{route('home.index')}}">На главную</a>
            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Следующие</a>
        </nav>
    </div>
@endsection
