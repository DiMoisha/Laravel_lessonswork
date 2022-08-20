@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>Заказ выгрузки данных</h2>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    @include('inc.message', ['message' => $error])
                @endforeach
            @endif
            <form method="post" action="{{ route('admin.order-store', ['status=1']) }}">
                @csrf
                <div class="form-group">
                    <label for="title">Ваше имя:</label>
                    <input type="text" class="form-control" name="customerName" id="customerName" value="{{ old('customerName') }}" required>
                </div>
                <div class="form-group">
                    <label for="title">Номер телефона:</label>
                    <input type="tel" class="form-control" name="customerTel" id="customerTel" value="{{ old('customerTel') }}" required>
                </div>
                <div class="form-group">
                    <label for="title">E-mail адрес:</label>
                    <input type="email" class="form-control" name="customerEmail" id="customerEmail" value="{{ old('customerEmail') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Какая информация вас интересует:</label>
                    <textarea class="form-control" name="description" id="description" required>{!! old('description') !!}</textarea>
                </div><br>
                <button class="btn btn-success" type="submit">Отправить</button>
            </form>
        </div>
    </div>
@endsection
