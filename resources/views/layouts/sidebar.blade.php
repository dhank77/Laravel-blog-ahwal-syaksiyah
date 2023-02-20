<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="index">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboards')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="menu"></i>
                        <span data-key="t-menu-utama">Menu Utama</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('utama.menu.index') }}" data-key="t-menu">Menu Website</a></li>
                        <li><a href="{{ route('utama.halaman.index') }}" data-key="t-halaman">Data Halaman</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-artikel">Artikel</span>
                    </a>
                    <ul class="sub-menu {{ request()->is('artikel/*') ? "mm-show" : "" }}" aria-expanded="false">
                        <li class="{{ request()->is('artikel/data/*') ? "mm-active" : "" }}" data-key="t-data"><a href="{{ route('artikel.artikel.index') }}">Data Artikel</a></li>
                        <li class="{{ request()->is('artikel/kategori/*') ? "mm-active" : "" }}" data-key="t-kategori"><a href="{{ route('artikel.kategori.index') }}">Kategori</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
