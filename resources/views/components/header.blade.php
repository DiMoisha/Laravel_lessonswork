<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-1 pt-1">
            <a class="link-secondary" href="/" title="Главная страница HotNews Новости"><img src="{{ asset('img/logo.png')}}" alt="Главная страница" /></a>
        </div>
        <div class="col-3 pt-1">
            <a class="link-secondary" href="#">Подписывайся</a>
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark text-d-none" href="/" title="Главная страница HotNews Новости">
                <span class="cl-red">Hot</span><span class="cl-blue">News</span>&nbsp;Новости
            </a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="link-secondary" href="#" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round"
                     stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewbox="0 0 24 24">
                    <title>Поиск</title>
                    <circle cx="10.5" cy="10.5" r="7.5"></circle>
                    <path d="M21 21l-5.2-5.2"></path>
                </svg>
            </a>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-admin ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">{{ __('Войти') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item ps-3">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('account.index') }}">Вы вошли как {{ Auth::user()->name }}!</a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('->Выйти') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
