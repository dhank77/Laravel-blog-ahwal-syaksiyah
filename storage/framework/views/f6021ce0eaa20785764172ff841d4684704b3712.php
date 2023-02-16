<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title"><?php echo app('translator')->get('translation.Menu'); ?></li>

                <li>
                    <a href="index">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?php echo app('translator')->get('translation.Dashboards'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="menu"></i>
                        <span data-key="t-menu-utama">Menu Utama</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('utama.menu.index')); ?>" data-key="t-menu">Menu Website</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-artikel">Artikel</span>
                    </a>
                    <ul class="sub-menu <?php echo e(request()->is('artikel/*') ? "mm-show" : ""); ?>" aria-expanded="false">
                        <li class="<?php echo e(request()->is('artikel/data/*') ? "mm-active" : ""); ?>" data-key="t-data"><a href="<?php echo e(route('artikel.artikel.index')); ?>">Data Artikel</a></li>
                        <li class="<?php echo e(request()->is('artikel/kategori/*') ? "mm-active" : ""); ?>" data-key="t-kategori"><a href="<?php echo e(route('artikel.kategori.index')); ?>">Kategori</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<?php /**PATH /Users/hamdaniilham/Laravel/ahwal-syaksiyah/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>