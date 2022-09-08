@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Заказ выгрузки данных</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.orders.store', ['status=1']) }}">
            @csrf
            <div class="form-group">
                <label for="sourceemail" @error('sourceemail') style="color:red" @enderror>E-mail источника</label>
                <input type="email" class="form-control" name="sourceemail" id="sourceemail" value="{{ old('sourceemail') }}">
            </div>
            <div class="form-group">
                <label for="customername" @error('customername') style="color:red" @enderror>Ваше имя</label>
                <input type="text" class="form-control" name="customername" id="customername" value="{{ old('customername') }}">
            </div>
            <div class="form-group">
                <label for="customertel" @error('customertel') style="color:red" @enderror>Номер телефона</label>
                <input type="text" class="form-control" name="customertel" id="customertel" value="{{ old('customertel') }}">
            </div>
            <div class="form-group">
                <label for="customeremail" @error('customeremail') style="color:red" @enderror>E-mail адрес</label>
                <input type="email" class="form-control" name="customeremail" id="customeremail" value="{{ old('customeremail') }}">
            </div>
            <div class="form-group">
                <label for="description" @error('description') style="color:red" @enderror>Какая информация вас интересует</label>
                <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
            </div>
            <hr>
            <button class="btn btn-outline-success" type="submit">Отправить заказ</button>
        </form>
    </div>
@endsection
