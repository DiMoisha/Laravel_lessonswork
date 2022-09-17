@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (!empty($news))
                <div class="blog-post">
                    <h2 class="blog-post-title">{{$news->title}}</h2>
                    <p class="blog-post-meta">{{$news->created_at}} <a href="#">{{$news->author}}</a></p>
                    @if (!empty($news->feedsource))
                        <div class="bg-ddd mb-4 mt-2 p-2">
                            <h3>Источник:</h3>
                            <span>{{$news->feedsource->sourcename}} - </span>
                            <a href="{{$news->feedsource->sourceurl}}" title="{{$news->feedsource->sourcename}}" target="_blank">{{$news->feedsource->sourceurl}}</a>
                        </div>
                    @endif
                    <div>
                        <img class="img-fluid" src="{{Storage::disk('public')->url($news->image)}}" width="300" height="200" alt="Изображение новости">
                    </div>
                    <p>{!! $news->description !!}</p>
                </div>
            @else
                <div class="col-md-12 bg-warning">
                    <h2 class="text-warning text-center">Такой новости нет!</h2>
                </div>
            @endif
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="{{route('news.index', ['id' => $categoryId])}}"><< Назад к списку новостей</a>
            </nav>
        </div>
    </div>
@endsection
