<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('img/user.png') }}">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#" aria-expanded="true">
                    <span>
                        Restoran
                        <span class="user-level">Administrator</span>
                    </span>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <ul class="nav">
            {{-- <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li> --}}
            <li class="nav-item {{ (request()->is('resep')) ? 'active' : '' }}">
                <a href="{{ route('resep.index') }}">
                    <i class="la la-table"></i>
                    <p>Resep Makanan</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('bahan')) ? 'active' : '' }}">
                <a href="{{ route('bahan.index') }}">
                    <i class="la la-table"></i>
                    <p>Bahan</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('kategori')) ? 'active' : '' }}">
                <a href="{{ route('kategori.index') }}">
                    <i class="la la-table"></i>
                    <p>Kategori</p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="components.html">
                    <i class="la la-table"></i>
                    <p>Components</p>
                    <span class="badge badge-count">14</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="forms.html">
                    <i class="la la-keyboard-o"></i>
                    <p>Forms</p>
                    <span class="badge badge-count">50</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="tables.html">
                    <i class="la la-th"></i>
                    <p>Tables</p>
                    <span class="badge badge-count">6</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="notifications.html">
                    <i class="la la-bell"></i>
                    <p>Notifications</p>
                    <span class="badge badge-success">3</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="typography.html">
                    <i class="la la-font"></i>
                    <p>Typography</p>
                    <span class="badge badge-danger">25</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="icons.html">
                    <i class="la la-fonticons"></i>
                    <p>Icons</p>
                </a>
            </li>
            <li class="nav-item update-pro">
                <button  data-toggle="modal" data-target="#modalUpdate">
                    <i class="la la-hand-pointer-o"></i>
                    <p>Update To Pro</p>
                </button>
            </li> --}}
        </ul>
    </div>
</div>