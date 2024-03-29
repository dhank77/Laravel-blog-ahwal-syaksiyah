<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/dashboard" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('logo.png') }}" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo.png') }}" alt="" height="24"> <span class="logo-txt" style="font-size:15px;">Hukum Keluarga</span>
                    </span>
                </a>

                <a href="/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('logo.png') }}" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo.png') }}" alt="" height="24"> <span class="logo-txt" style="font-size:15px;">Hukum Keluarga</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block" action="#">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex">


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="@if (Auth::user()->avatar != ''){{ asset('images/'. Auth::user()->avatar) }}@else{{ asset('assets/images/users/avatar-1.png') }}@endif" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> @lang('translation.Profile')</a>
                    <a class="dropdown-item" href="{{ route('passwordIndex') }}"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Ubah Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item " href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
