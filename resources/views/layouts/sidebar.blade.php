<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu Utama</li>

                <li>
                    <a class="{{ request()->is('dashboard/*') ? "mm-active" : "" }}" href="/dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
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
                <li>
                    <a class="{{ request()->is('pengumuman/*') ? "mm-active" : "" }}" href="{{ route('pengumuman.index') }}">
                        <i data-feather="list"></i>
                        <span data-key="t-pengumuman">Pengumuman</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('pengajar/*') ? "mm-active" : "" }}" href="{{ route('pengajar.index') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-staff">Staff Pengajar</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('komplain/*') ? "mm-active" : "" }}" href="{{ route('komplain.index') }}">
                        <i data-feather="rss"></i>
                        <span data-key="t-komplain">Data Komplain</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('download/*') ? "mm-active" : "" }}" href="{{ route('download.index') }}">
                        <i data-feather="download"></i>
                        <span data-key="t-download">File Download</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('berkas/*') ? "mm-active" : "" }}" href="{{ route('berkas.index') }}">
                        <i data-feather="archive"></i>
                        <span data-key="t-download">Berkas</span>
                    </a>
                </li>
                  <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-setting">Setting Website</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('setting.banner.index') }}" data-key="t-banner">Banner</a></li>
                        <li><a href="{{ route('setting.sambutan.index') }}" data-key="t-sambutan">Sambutan</a></li>
                        <li><a href="{{ route('setting.testimoni.index') }}" data-key="t-testimoni">Testimoni</a></li>
                        <li><a href="{{ route('setting.footer.index') }}" data-key="t-footer">Footer</a></li>
                    </ul>
                </li>
                  <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-admin">Admin</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('setting.sambutan.index') }}" data-key="t-super">Super Admin</a></li>
                        <li><a href="{{ route('admin.publisher.index') }}" data-key="t-publisher">Publisher</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
