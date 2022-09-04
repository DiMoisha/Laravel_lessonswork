@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Добавить категорию</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.categories.store', ['status=1']) }}">
            @csrf
            <div class="form-group">
                <label for="title" @error('title') style="color:red" @enderror>Наименование</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description" @error('description') style="color:red" @enderror>Описание</label>
                <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
            </div>
            <div class="form-group">
                <label for="tabindex" @error('tabindex') style="color:red" @enderror>Порядковый номер</label>
                <input type="number" class="form-control" name="tabindex" id="tabindex" value="{{ old('tabindex') }}">
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
