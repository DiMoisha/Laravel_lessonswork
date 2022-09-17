@extends('layouts.admin')
@section('content')
    <h2>Список категорий</h2>
    <div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить категорию</a>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">ID</th>
                <th scope="col">Наименование</th>
                <th scope="col">Порядковый №</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $key => $category)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $category->categoryid }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->tabindex }}</td>
                    <td>{{ $category->created_at->format('d-m-Y H:i') }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-warning" href="{{ route('admin.categories.edit', ['category' => $category->categoryid]) }}" title="Редактировать категорию">Ред.</a> &nbsp;
                        <form method="post" action="{{ route('admin.categories.destroy', ['category' => $category->categoryid]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" title="Удалить категорию">Уд.</button>
                        </form>
{{--                        <a href="javascript:" class="delete" onclick="delCategory({{ $category->categoryid }})" rel="{{ $category->categoryid }}" data-confirm="Вы уверены?" data-method="delete" style="color: red;">Уд.</a>--}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Категорий пока нет!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
@endsection
@push('js')
    <script>
        function delCategory(id) {
            if(confirm(`Подтверждаете удаление записи с ID = ${id}`)) {
                send(`/admin/categories/${id}`).then(() => {
                    location.reload();
                });
            }else {
                alert("Удаление отменено");
            }
        }

        async function send(url) {
            alert(url);
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
