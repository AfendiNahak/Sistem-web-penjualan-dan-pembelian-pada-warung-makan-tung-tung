<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column" id="sidebar">
        <a href="" id="sidepanel-close" class="sidepanel-close"><i class="fa-solid fa-xmark"></i></a>
        <div class="app-branding">
            <a class="app-logo d-flex align-items-center" href="/">
                <img class="logo-icon " src="/assets/images/logo_warung.png" alt="logo">
            </a>
        </div>
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1 mt-3">
            <ul class="app-menu list-unstyled accordion">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <span class="nav-icon">
                            <i class="fa-solid fa-house-chimney"></i>
                        </span>
                        <span class="nav-link-text">Home</span>
                    </a>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('menu') ? 'active' : (Request::is('menu/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-1"
                        aria-expanded="{{ Request::is('menu') ? 'true' : (Request::is('menu/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-1" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-utensils"></i>
                        </span>
                        <span class="nav-link-text">Menu</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-1"
                        class="submenu submenu-1 {{ Request::is('menu') ? 'collapse show' : (Request::is('menu/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ Request::is('menu') ? 'active' :  ''}}"
                                    href="{{ route('menu.index') }}">Data Menu</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('menu/create') ? 'active' :  ''}}"
                                    href="{{ route('menu.create') }}">Tambah Data</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('penjualan') ? 'active' : (Request::is('penjualan/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-2"
                        aria-expanded="{{ Request::is('penjualan') ? 'true' : (Request::is('penjualan/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-2" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-tags"></i>
                        </span>
                        <span class="nav-link-text">Penjualan</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-2"
                        class="submenu submenu-2 {{ Request::is('penjualan') ? 'collapse show' : (Request::is('penjualan/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('penjualan') ? 'active' :  ''}}"
                                    href="{{ route('penjualan.index') }}">Data Penjualan</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('penjualan/create') ? 'active' :  ''}}"
                                    href="{{ route('penjualan.create') }}">Tambah Data</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('pembelian') ? 'active' : (Request::is('pembelian/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-4"
                        aria-expanded="{{ Request::is('pembelian') ? 'true' : (Request::is('pembelian/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-4" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </span>
                        <span class="nav-link-text">Pembelian</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-4"
                        class="submenu submenu-4 {{ Request::is('pembelian') ? 'collapse show' : (Request::is('pembelian/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('pembelian') ? 'active' :  ''}}"
                                    href="/pembelian">Data Pembelian</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('pembelian/create') ? 'active' :  ''}}"
                                    href="/pembelian/create">Tambah Data</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('biaya-lain') ? 'active' : (Request::is('biaya-lain/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-7"
                        aria-expanded="{{ Request::is('biaya-lain') ? 'true' : (Request::is('biaya-lain/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-7" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </span>
                        <span class="nav-link-text">Biaya Lain-Lain</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-7"
                        class="submenu submenu-7 {{ Request::is('biaya-lain') ? 'collapse show' : (Request::is('biaya-lain/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('biaya-lain') ? 'active' :  ''}}"
                                    href="/biaya-lain">Biaya Lain-Lain</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('biaya-lain/create') ? 'active' :  ''}}"
                                    href="/biaya-lain/create">Tambah Data</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('supplier') ? 'active' : (Request::is('supplier/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-5"
                        aria-expanded="{{ Request::is('supplier') ? 'true' : (Request::is('supplier/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-5" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="nav-link-text">Supplier</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-5"
                        class="submenu submenu-5 {{ Request::is('supplier') ? 'collapse show' : (Request::is('supplier/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('supplier') ? 'active' :  ''}}"
                                    href="/supplier">Data Supplier</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('supplier/create') ? 'active' :  ''}}"
                                    href="/supplier/create">Tambah Data</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('pelanggan') ? 'active' : (Request::is('pelanggan/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-6"
                        aria-expanded="{{ Request::is('pelanggan') ? 'true' : (Request::is('pelanggan/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-6" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="nav-link-text">Pelanggan</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-6"
                        class="submenu submenu-6 {{ Request::is('pelanggan') ? 'collapse show' : (Request::is('pelanggan/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('pelanggan') ? 'active' :  ''}}"
                                    href="/pelanggan">Data Pelanggan</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('pelanggan/create') ? 'active' :  ''}}"
                                    href="/pelanggan/create">Tambah Data</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is(" laba-rugi") ? 'active' : '' }}" href="/laba-rugi">
                        <span class="nav-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </span>
                        <span class="nav-link-text">Laporan Laba/Rugi</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>