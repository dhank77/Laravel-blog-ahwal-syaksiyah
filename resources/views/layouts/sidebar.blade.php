<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="index">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboards')</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-apps">@lang('translation.Apps')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-ecommerce">Artikel</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('artikel.artikel.index') }}" key="t-products">Data Artikel</a></li>
                        <li><a href="{{ route('artikel.kategori.index') }}" data-key="t-product-detail">Kategori</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
