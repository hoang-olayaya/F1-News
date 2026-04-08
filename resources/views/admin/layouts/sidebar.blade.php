<aside class="app-sidebar bg-body-secondary shadow-sm" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <span class="brand-text fw-light">F1 NEWS ADMIN</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Quản lý Danh Mục</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Quản lý Bài viết</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('comments.index') }}" class="nav-link {{ request()->routeIs('comments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Quản lý Bình luận</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>