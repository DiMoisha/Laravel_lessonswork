@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Редактировать новость</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="categoryid" @error('categoryid') style="color:red" @enderror>Выбрать категорию</label>
                <select class="form-control" name="categoryid" id="categoryid">
                    <option value="0">Выбрать</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->categoryid }}" @if($news->categoryid === $category->categoryid) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="feedsourceid" @error('feedsourceid') style="color:red" @enderror>Выбрать источник новости</label>
                <select class="form-control" name="feedsourceid" id="feedsourceid">
                    <option value="0">Выбрать</option>
                    @foreach($feedsources as $feedsource)
                        <option value="{{ $feedsource->feedsourceid }}" @if($news->feedsourceid === $feedsource->feedsourceid) selected @endif>{{ $feedsource->sourcename }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title" @error('title') style="color:red" @enderror>Заголовок</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}">
            </div>
            <div class="form-group">
                <label for="description" @error('description') style="color:red" @enderror>Содержание новости</label>
                <textarea class="form-control" name="description" id="description">{!! $news->description !!}</textarea>
            </div>
            <div class="form-group">
                <label for="author" @error('author') style="color:red" @enderror>Автор</label>
                <input type="text" class="form-control" name="author" id="author" value="{{ $news->author }}">
            </div>
            <div class="form-group">
                <label for="status" @error('status') style="color:red" @enderror>Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if($news->status === 'DRAFT' ) selected @endif>DRAFT</option>
                    <option @if($news->status === 'ACTIVE' ) selected @endif>ACTIVE</option>
                    <option @if($news->status === 'BLOCKED' ) selected @endif>BLOCKED</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image" @error('image') style="color:red" @enderror>Изображение</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ $news->image }}">
                <label>Сейчас выбрано: {{ $news->image }}</label>
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('description', options);
    </script>



{{--    <script src="{{asset('vendor/ckeditor5/ckeditor.js')}}"></script>--}}
{{--    <script>--}}
{{--        ClassicEditor--}}
{{--            .create( document.querySelector( '#description' ), {--}}
{{--                ckfinder: {--}}
{{--                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',--}}
{{--                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',--}}
{{--                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',--}}
{{--                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='--}}
{{--            }} )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
@endpush
