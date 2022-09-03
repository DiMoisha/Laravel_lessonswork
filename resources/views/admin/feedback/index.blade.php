@extends('layouts.admin')
@section('content')
    <h2>Список сообщений обратной связи</h2>
    <br>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя отправителя</th>
                <th scope="col">E-mail отправителя</th>
                <th scope="col">Дата добавления</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($feedbackList as $key => $feedback)
                <tr>
                    <td>{{ $feedback->feedbackid }}</td>
                    <td>{{ $feedback->sendername }}</td>
                    <td>{{ $feedback->senderemail }}</td>
                    <td>{{ $feedback->created_at->format('d-m-Y H:i') }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-primary" href="{{ route('admin.feedback.show', ['feedback' => $feedback->feedbackid]) }}" title="Подробнее">Подробнее</a> &nbsp;
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Сообщений пока нет!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$feedbackList->links()}}
    </div>
@endsection
