@extends('layouts.admin')
@section('content')
    <h2>Список заказов выгрузки данных из сторонних источников</h2>
    <a href="{{ route('admin.order-create') }}" class="btn btn-primary">Добавить заказ</a>
    <div class="table-responsive p-4">
        <p class="text-warning bg-dark text-light">Тут будет список заказов!</p>
    </div>
@endsection



