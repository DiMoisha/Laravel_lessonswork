@extends('layouts.admin')
@section('content')
    <h2>Список источников новостей</h2>
    <div>
        <a href="{{ route('admin.feedsources.create') }}" class="btn btn-primary">Добавить источник новостей</a>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Наименование</th>
                <th scope="col">URL источника</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($feedsources as $key => $feedsource)
                <tr>
                    <td>{{ $feedsource->feedsourceid }}</td>
                    <td>{{ $feedsource->sourcename }}</td>
                    <td>{{ $feedsource->sourceurl }}</td>
                    <td>{{ $feedsource->created_at->format('d-m-Y H:i') }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-warning" href="{{ route('admin.feedsources.edit', ['feedsource' => $feedsource->feedsourceid]) }}" title="Редактировать источник">Ред.</a> &nbsp;
                        <form method="post" action="{{ route('admin.feedsources.destroy', ['feedsource' => $feedsource->feedsourceid]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" title="Удалить источник">Уд.</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Источников новостей пока нет!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$feedsources->links()}}
    </div>
@endsection
