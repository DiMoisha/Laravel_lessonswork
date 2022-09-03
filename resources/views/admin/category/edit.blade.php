@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Редактировать категорию</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Наименование</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description">{!! $category->description !!}</textarea>
            </div>
            <div class="form-group">
                <label for="tabindex">Порядковый номер</label>
                <input type="number" class="form-control" name="tabindex" id="tabindex" value="{{ $category->tabindex }}">
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
