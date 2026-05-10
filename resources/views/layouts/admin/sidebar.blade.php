<!-- Sidenav Menu Start -->
<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{ asset('/') }}logo/LogoDigiCodein.png"></span>
            <span class="logo-sm"><img src="{{ asset('/') }}logo/LogoDigiCodein.png"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{ asset('/') }}logo/LogoDigiCodein.png"></span>
            <span class="logo-sm"><img src="{{ asset('/') }}logo/LogoDigiCodein.png"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ri-close-line align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin.home') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-home-6-line"></i></span>
                    <span class="menu-text"> Beranda </span>
                    <span class="badge bg-danger rounded-pill">5</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.transaction.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-bill-line"></i></span>
                    <span class="menu-text"> Transaksi </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.orders.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-receipt-line"></i></span>
                    <span class="menu-text"> Orders </span>
                </a>
            </li>

            @can('product-manajemen')
            <li class="side-nav-title mt-2">Produk</li>

            @can('product-kategoriList')
            <li class="side-nav-item">
                <a href="{{ route('admin.product_category') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>
                    <span class="menu-text"> Kategori Produk </span>
                </a>
            </li>
            @endcan
            @can('product-list')
            <li class="side-nav-item">
                <a href="{{ route('admin.product') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>
                    <span class="menu-text"> Produk </span>
                </a>
            </li>
            @endcan
            @endcan

            @can('user-manajemen')
            <li class="side-nav-title mt-2">User Manajemen</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.users') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-user-line"></i></span>
                    <span class="menu-text"> Pengguna </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.roles') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-shield-keyhole-line"></i></span>
                    <span class="menu-text"> Akses User </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.permission') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-admin-line"></i></span>
                    <span class="menu-text"> Permissions </span>
                </a>
            </li>

            <li class="side-nav-title mt-2">Pengaturan</li>
            <li class="side-nav-item">
                <a href="{{ route('admin.slider.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>
                    <span class="menu-text"> Sliders </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>
                    <span class="menu-text"> Fiturs </span>
                </a>
            </li>
            @endcan

        </ul>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Sidenav Menu End -->
