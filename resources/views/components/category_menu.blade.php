@if (count($categories) > 0)
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between category-menu">
            @foreach($categories as $category)
                <a class="p-2 link-secondary @isset($categoryId) @if($category->categoryid == $categoryId) active @endif @endisset" href="{{route('news.index', ['id' => $category->categoryid])}}">
                    {{$category->title}}
                </a>
            @endforeach
        </nav>
    </div>
@endif
