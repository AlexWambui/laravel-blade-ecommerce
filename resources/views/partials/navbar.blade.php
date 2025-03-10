<nav>
    <div class="brand">
        <a href="{{ Route::has('home-page') ? route('home-page') : '#' }}" class="title">
            {{ $appSettings['app_acronym'] ?? config('globals.app_acronym') }}
        </a>
    </div>

    <div class="nav_links">
        @php
            $nav_links = [
                // ['route' => 'about-page', 'text' => 'About'],
                // ['route' => 'users.blogs', 'text' => 'Blogs'],
                ['route' => 'home-page', 'text' => 'Home'],
                ['route' => 'shop-page', 'text' => 'Shop'],
                ['route' => 'contact-page', 'text' => 'Contact'],
            ];
        @endphp

        @auth            
            <a href="{{ Route::has('dashboard') ? route('dashboard') : '#' }}">Dashboard</a>
        @endauth

        @foreach($nav_links as $nav_link)
            <a 
            href="{{ Route::has($nav_link['route']) ? route($nav_link['route']) : '#' }}" 
            class="nav_link {{ Route::currentRouteName() === $nav_link['route'] ? 'active' : '' }}">
                {{ $nav_link['text'] }}
            </a>
        @endforeach
    </div>
    
    <div class="extra_links">
        <div class="links">
            <div class="shopping_cart">
                <a href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>{{ session('cart_count', 0) }}</span>
                </a>
            </div>

            @if(Auth::user())
                <form action="{{ route('logout') }}" method="post">
                    @csrf

                    <button type="submit" class="btn btn_logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn_login">Login</a>
            @endif
        </div>
    </div>

    <div class="burger_menu">
        <div class="burger_icon" id="burgerIcon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>