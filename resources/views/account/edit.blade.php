@extends('layouts.main')
@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h2>Редактировать регистрационные данные:</h2>
            @include('inc.message')
            <form method="post" action="{{ route('account.update', ['account' => $account]) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name" @error('name') style="color:red" @enderror>Имя пользователя</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $account->name }}">
                </div>
                <div class="form-group">
                    <label for="email" @error('email') style="color:red" @enderror>Электронная почта</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $account->email }}">
                </div>
                <div class="form-group">
                    <label for="password" @error('password') style="color:red" @enderror>Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                </div>
                <div class="form-group">
                    <label for="confirmPassword" @error('confirmPassword') style="color:red" @enderror>Подтверждение пароля</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="">
                </div>
                <br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
        <div class="col-md-8 my-5">
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="{{ route('account.index') }}"><< В личный кабинет</a>
            </nav>
        </div>
    </div>
@endsection
