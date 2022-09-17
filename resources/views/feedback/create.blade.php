@extends('layouts.main')
@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h2>Напишите нам:</h2>
            @include('inc.message')
            <form method="post" action="{{ route('feedback.store', ['status=1']) }}">
                @csrf
                <div class="form-group">
                    <label for="sendername" @error('sendername') style="color:red" @enderror>Ваше имя</label>
                    <input type="text" class="form-control" name="sendername" id="sendername" value="{{ old('sendername') }}" required>
                </div>
                <div class="form-group">
                    <label for="senderemail" @error('senderemail') style="color:red" @enderror>Ваш e-mail для связи</label>
                    <input type="email" class="form-control" name="senderemail" id="senderemail" value="{{ old('senderemail') }}">
                </div>
                <div class="form-group">
                    <label for="message" @error('message') style="color:red" @enderror>Ваш отзыв или предложение</label>
                    <textarea class="form-control" name="message" id="message" required>{!! old('message') !!}</textarea>
                </div><br>
                <button class="btn btn-outline-success" type="submit">Отправить</button>
            </form>
        </div>
        <div class="col-md-8 my-5">
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="{{ route('home.index') }}">На главную</a>
            </nav>
        </div>
    </div>
@endsection
