@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (count($news) > 0)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{$news['title']}}</h2>
                    <p class="blog-post-meta">{{$news['created_at']->format('d-m-Y H:i')}} <a href="#">{{$news['author']}}</a></p>
                    <p>{{$news['description']}}</p>
                </div>
            @else
                <div class="col-md-12 bg-warning">
                    <h2 class="text-warning text-center">Такой новости нет!</h2>
                </div>
            @endif
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="{{route('news.index', ['id' => $news['categoryId']])}}"><< Назад к списку новостей</a>
                <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Следующая новость</a>
            </nav>
        </div>
    </div>
@endsection
