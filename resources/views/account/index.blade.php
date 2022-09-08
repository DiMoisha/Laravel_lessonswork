@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('inc.message')
            <h2>Здравствуйте, {{ Auth::user()->name }}!</h2>
            <br>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="blog-post border border-1 border-dark p-2">
                <h3>Данные, которые вы указали при регистрации</h3>
                <p>Email: {{ Auth::user()->email }}</p>
                <p>Дата регистрации: {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                <a href="{{ route('account.edit', ['account' => Auth::user()]) }}" class="btn btn-outline-secondary">Редактировать</a>
            </div>
            <hr>
            <nav class="blog-pagination">
                @if(Auth::user()->is_admin === true)
                   <a class="btn btn-outline-primary" href="{{ route('admin.index') }}">Панель администратора</a>
                @endif
                <a class="btn btn-outline-primary" href="{{route('home.index')}}">На главную</a>
            </nav>
        </div>
    </div>
@endsection
