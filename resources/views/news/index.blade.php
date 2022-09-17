@extends('layouts.main')
@section('content')
    <div class="row mb-2">
        {{$newsList->links()}}
        @forelse($newsList as $key => $news)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">{{$categoryTitle}}</strong>
                        <h2 class="mb-0">{{$news->title}}</h2>
                        <div class="mb-1 text-muted">{{$news->author}} - {{$news->created_at}}</div>
                        <div>
                            <img class="img-thumbnail" src="{{Storage::disk('public')->url($news->image)}}" width="200" height="200" alt="Изображение новости">
                        </div>
                        <div class="card-text mb-auto news-list-item pb-2 h-50px">{!! $news->description !!}</div>
                        <a href="{{route('news.show', ['id' => $news->newsid])}}" class="stretched-link">Перейти к новости</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 bg-warning">
                <h2 class="text-warning text-center">В этой категории пока новостей нет!</h2>
            </div>
        @endforelse
        {{$newsList->links()}}
        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="{{route('home.index')}}">На главную</a>
        </nav>
    </div>

@endsection
