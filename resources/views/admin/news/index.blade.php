@extends('layouts.admin')
@section('content')
    <h2>Список новостей</h2>
    <div>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Добавить новость</a>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Категория</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Автор</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $key => $news)
                <tr>
                    <td>{{ $news->newsid }}</td>
                    <td>{{ $news->category->title }}</td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->author }}</td>
                    <td>{{ $news->status }}</td>
                    <td>{{ $news->created_at->format('d-m-Y H:i') }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-warning" href="{{ route('admin.news.edit', ['news' => $news->newsid]) }}" title="Редактировать новость">Ред.</a> &nbsp;
                        <form method="post" action="{{ route('admin.news.destroy', ['news' => $news->newsid]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" title="Удалить новость">Уд.</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Новостей пока нет!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$newsList->links()}}
    </div>
@endsection
