@extends('layouts.admin')
@section('content')
    <h2>Список заказов выгрузки данных из сторонних источников</h2>
    <div>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Добавить заказ</a>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">E-mail источника</th>
                <th scope="col">Имя заказчика</th>
                <th scope="col">Тел. Заказчика</th>
                <th scope="col">Е-mail заказчика</th>
                <th scope="col">Дата добавления</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $key => $order)
                <tr>
                    <td>{{ $order->orderid }}</td>
                    <td>{{ $order->sourceemail }}</td>
                    <td>{{ $order->customername }}</td>
                    <td>{{ $order->customertel }}</td>
                    <td>{{ $order->customeremail }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Заказов пока нет!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$orders->links()}}
    </div>
@endsection
