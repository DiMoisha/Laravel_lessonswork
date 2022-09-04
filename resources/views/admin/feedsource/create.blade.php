@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Добавить источник данных</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.feedsources.store', ['status=1']) }}">
            @csrf
            <div class="form-group">
                <label for="sourcename" @error('sourcename') style="color:red" @enderror>Наименование источника</label>
                <input type="text" class="form-control" name="sourcename" id="sourcename" value="{{ old('sourcename') }}">
            </div>
            <div class="form-group">
                <label for="sourceurl" @error('sourceurl') style="color:red" @enderror>URL источника</label>
                <input type="url" class="form-control" name="sourceurl" id="sourceurl" value="{{ old('sourceurl') }}">
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
