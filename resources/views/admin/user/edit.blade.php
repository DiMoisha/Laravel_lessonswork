@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Редактировать данные пользователя</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.users.update', ['user' => $user]) }}">
            @csrf
            @method('put')
            <input type="text" class="form-control" name="password" id="password" value="{{ $user->password }}" hidden>
            <input type="text" class="form-control" name="confirmPassword" id="confirmPassword" value="{{ $user->password }}" hidden>
            <div class="form-group">
                <label for="name" @error('name') style="color:red" @enderror>Имя пользователя</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email" @error('email') style="color:red" @enderror>Электронная почта</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="is_admin" @error('is_admin') style="color:red" @enderror>Выбрать группу</label>
                <select class="form-control" name="is_admin" id="is_admin">
                    <option @if($user->is_admin === true) selected @endif value="1">Админ</option>
                    <option @if($user->is_admin === false) selected @endif value="0">Пользователь</option>
                </select>
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
