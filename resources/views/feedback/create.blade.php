@extends('layouts.main')
@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h2>Напишите нам:</h2>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    @include('inc.message', ['message' => $error])
                @endforeach
            @endif
            <form method="post" action="{{ route('feedback.store', ['status=1']) }}">
                @csrf
                <div class="form-group">
                    <label for="title">Ваше имя:</label>
                    <input type="text" class="form-control" name="senderName" id="senderName" value="{{ old('senderName') }}" required>
                </div>
                <div class="form-group">
                    <label for="title">Ваш e-mail для связи:</label>
                    <input type="email" class="form-control" name="senderEmail" id="senderEmail" value="{{ old('senderEmail') }}">
                </div>
                <div class="form-group">
                    <label for="message">Ваш отзыв или предложение:</label>
                    <textarea class="form-control" name="message" id="message" required>{!! old('message') !!}</textarea>
                </div><br>
                <button class="btn btn-outline-success" type="submit">Отправить</button>
            </form>
        </div>
        <div class="col-md-8 my-5">
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="{{ route('home.index') }}">На главную</a>
                <a class="btn btn-outline-secondary" href="{{ route('feedback.index') }}">Список отзывов</a>
            </nav>
        </div>
    </div>
@endsection
