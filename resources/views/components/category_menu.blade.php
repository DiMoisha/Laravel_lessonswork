@if (count($categories) > 0)
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach($categories as $key => $category)
                <a class="p-2 link-secondary" href="{{route('news.index', ['id' => $category['categoryId']])}}">
                    {{$category['title']}}
                </a>
            @endforeach
        </nav>
    </div>
@endif
