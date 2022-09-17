@extends('layouts.admin')
@section('content')
    <h1>
        Панель администратора HotNews Новости
    </h1>
    <br>
    <br>
    <a href="{{ route('admin.parser') }}">Парсить новости</a>
    <br>
    @php $message = "Test message"; @endphp
    <br>
    <x-alert type="warning" :message="$message"></x-alert>
    <x-alert type="success" :message="$message"></x-alert>
    <x-alert type="primary" :message="$message"></x-alert>
    <x-alert type="danger" :message="$message"></x-alert>
    <x-alert type="info" :message="$message"></x-alert>
@endsection
