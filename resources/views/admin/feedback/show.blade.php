@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Сообщение обратной связи</h2>
        @include('inc.message')
        <div class="form-group">
            <label for="sendername">Имя отправителя</label>
            <p class="form-control" id="sendername">{{ $feedback->sendername }}</p>
        </div>
        <div class="form-group">
            <label for="senderemail">E-mail отправителя</label>
            <p class="form-control" id="senderemail">{{ $feedback->senderemail }}</p>
        </div>
        <div class="form-group">
            <label for="message">Сообщение</label>
            <p class="form-control" id="message">{!! $feedback->message !!}</p>
        </div>
        <hr>
        <a class="btn btn-outline-success" href="{{ route('admin.feedback.index') }}" title="К списку сообщений обратной связи">К списку сообщений</a>
    </div>
@endsection
