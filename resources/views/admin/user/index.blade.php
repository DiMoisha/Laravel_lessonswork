@extends('layouts.admin')
@section('content')
    <h2>Список пользователей</h2>
    <br>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Имя</th>
                <th scope="col">Электронная почта</th>
                <th scope="col">Права</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr id="row-{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if($user->is_admin) Администратор @endif</td>
                    <td>{{ $user->created_at }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-warning" href="{{ route('admin.users.edit', ['user' => $user]) }}" title="Редактировать пользователя">Ред.</a> &nbsp;
                        <form method="post" action="{{ route('admin.users.destroy', ['user' => $user->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" title="Удалить пользователя">Уд.</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Пользователей пока нет!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
