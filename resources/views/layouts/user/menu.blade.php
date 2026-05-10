<!-- Horizontal Menu Start -->
<header class="topnav">
    <nav class="navbar navbar-expand-lg">
        <nav class="page-container">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown hover-dropdown">
                        <a class="nav-link dropdown-toggle drop-arrow-none" href="{{ route('frontend.index') }}">
                            <span class="menu-icon"><i class="ri-airplay-line"></i></span>
                            <span class="menu-text"> Beranda </span>
                        </a>
                    </li>
                    </li>

                    @foreach ($categorys as $menu)
                        <li class="nav-item dropdown hover-dropdown">
                            <a class="nav-link dropdown-toggle drop-arrow-none" href="{{ route('frontend.category_product',['slug' => $menu->slug]) }}">
                                <span class="menu-icon">{!! $menu->icon !!}</span>
                                <span class="menu-text"> {{ $menu->category }} </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </nav>
</header>
<!-- Horizontal Menu End -->
