<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?php echo app('translator')->get('translation.Menu'); ?></li>

                <li>
                    <a href="index">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?php echo app('translator')->get('translation.Dashboards'); ?></span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-apps"><?php echo app('translator')->get('translation.Apps'); ?></li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-ecommerce">Artikel</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('artikel.artikel.index')); ?>" key="t-products">Data Artikel</a></li>
                        <li><a href="<?php echo e(route('artikel.kategori.index')); ?>" data-key="t-product-detail">Kategori</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<?php /**PATH /Users/hamdaniilham/Laravel/ahwal-syaksiyah/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>