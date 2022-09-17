@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Редактировать источник данных</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.feedsources.update', ['feedsource' => $feedsource]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="sourcename" @error('sourcename') style="color:red" @enderror>Наименование источника</label>
                <input type="text" class="form-control" name="sourcename" id="sourcename" value="{{ $feedsource->sourcename }}">
            </div>
            <div class="form-group">
                <label for="sourceurl" @error('sourceurl') style="color:red" @enderror>URL источника</label>
                <input type="url" class="form-control" name="sourceurl" id="sourceurl" value="{{ $feedsource->sourceurl }}">
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
