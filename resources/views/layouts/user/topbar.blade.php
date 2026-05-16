<!-- Color Top line -->
<div class="color-line_new"></div>

<!-- Topbar Start -->
<header class="app-topbar">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <!-- Brand Logo -->
            <a href="{{ route('frontend.index') }}" class="logo">
                <span class="logo-light">
                    <span class="logo-lg"><img src="{{ asset('/') }}logo/LogoDigiCodein.png" style="width: 150px; height: 50px" alt="logo"></span>
                    <span class="logo-sm"><img src="{{ asset('/') }}logo/LogoDigiCodein.png" style="width: 150px; height: 50px" alt="small logo"></span>
                </span>

                <span class="logo-dark">
                    <span class="logo-lg"><img src="{{ asset('/') }}logo/LogoDigiCodein.png" style="width: 150px; height: 50px" alt="dark logo"></span>
                    <span class="logo-sm"><img src="{{ asset('/') }}logo/LogoDigiCodein.png" style="width: 150px; height: 50px" alt="small logo"></span>
                </span>
            </a>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <!-- Topbar Page Title -->
            <div class="topbar-item d-none d-md-flex">
                <?php if (isset($title)): ?>
                <div>
                    <h4 class="page-title fs-18 fw-bold mb-0"><?= $title ?></h4>
                    <ol class="breadcrumb m-0 mt-1 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Highdmin</a></li>
                        <li class="breadcrumb-item active"><?= $subtitle ?></li>
                    </ol>
                </div>
                <?php endif ?>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            @auth
            <!-- Search for small devices -->
            <div class="topbar-item d-flex d-xl-none">
                <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                    <i class="ri-search-line fs-22"></i>
                </button>
            </div>

            <!-- Button Trigger Search Modal -->
            <div class="topbar-search d-none d-xl-flex gap-2 me-2 align-items-center" data-bs-toggle="modal"
                data-bs-target="#searchModal" type="button">
                <i class="ri-search-line fs-18"></i>
                <span class="me-2">Search something..</span>
            </div>

            <!-- Light/Dark Mode Button -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" id="light-dark-mode" type="button">
                    <i class="ri-moon-line fs-22"></i>
                </button>
            </div>
            <div class="topbar-item d-none d-sm-flex">
                <a href="{{ route('user.cart') }}" class="topbar-link" >
                    <i class="ri-account-circle-line fs-22"></i>
                </a>
            </div>

            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('/') }}assets/images/users/avatar-1.jpg" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            {{-- <h5 class="my-0">{{ auth()->user()->name }}</h5> --}}
                        </span>
                        <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Halo, {{ auth()->user()->name }} !</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ route('user.home') }}" class="dropdown-item">
                            <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">My Dashboard</span>
                        </a>
                        <a href="{{ route('user.cart') }}" class="dropdown-item">
                            <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Cart</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ri-wallet-3-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Wallet : <span class="fw-semibold">Coming Soon</span></span>
                        </a>

                        <!-- item-->
                        <a href="{{ route('user.account') }}" class="dropdown-item">
                            <i class="ri-settings-2-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Settings</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="topbar-item nav-user">
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary-new"><i class="ri-login-box-line me-2"></i> Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary-new"><i class="ri-add-line me-2"></i> Daftar</a>
            </div>
            @endauth
        </div>
    </div>
</header>
<!-- Topbar End -->

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-transparent">
            <form>
                <div class="card mb-1">
                    <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                        <i class="ri-search-line fs-22"></i>
                        <input type="search" class="form-control border-0" id="search-modal-input"
                            placeholder="Search for actions, people,">
                        <button type="submit" class="btn p-0" data-bs-dismiss="modal"
                            aria-label="Close">[esc]</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
