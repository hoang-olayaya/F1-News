<!DOCTYPE html>
<html lang="vi" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'F1 News - Thể Thao Tốc Độ')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Oswald:wght@500;700&display=swap" rel="stylesheet">

    <style>
        /* Default Light Mode Variables */
        :root, [data-bs-theme="light"] {
            --f1-red: #e10600;
            --f1-bg: #f8f9fa; /* Light gray background */
            --f1-card-bg: #ffffff; /* White cards */
            --f1-text: #212529; /* Dark text for readability */
            --f1-muted: #6c757d;
        }

        /* Dark Mode Variables */
        [data-bs-theme="dark"] {
            --f1-red: #e10600;
            --f1-bg: #15151e; /* Dark F1 background */
            --f1-card-bg: #1f1f27;
            --f1-text: #ffffff; /* White text */
            --f1-muted: #d0d0d2;
        }

        body {
            background-color: var(--f1-bg) !important;
            color: var(--f1-text) !important;
            font-family: 'Montserrat', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        h1, h2, h3, h4, h5, h6, .f1-font {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        /* Header & Navbar */
        .navbar {
            background-color: var(--f1-card-bg);
            border-bottom: 3px solid var(--f1-red);
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .navbar .navbar-brand,
        .navbar .nav-link {
            color: var(--f1-text) !important;
        }
        .navbar .navbar-toggler {
            border-color: var(--bs-border-color);
            color: var(--f1-text);
        }
        .navbar-brand span {
            color: var(--f1-red);
        }
        .nav-link {
            font-family: 'Oswald', sans-serif;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--f1-red) !important;
        }
        /* Nút bấm */
        .btn-f1 {
            background-color: var(--f1-red);
            color: white;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            border-radius: 4px;
            transition: 0.3s;
        }
        .btn-f1:hover {
            background-color: #b30500;
            color: white;
        }
        /* Footer */
        footer {
            background-color: var(--f1-card-bg);
            border-top: 1px solid var(--bs-border-color);
            margin-top: 60px;
        }

        /* ---- Giao diện Menu Dropdown ---- */
        .f1-dropdown-menu {
            background-color: var(--f1-card-bg);
            border-top: 3px solid var(--f1-red) !important;
            border-radius: 0 0 4px 4px;
            border-color: var(--bs-border-color) !important;
        }
        .f1-dropdown-menu .dropdown-item {
            font-family: 'Oswald', sans-serif;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--f1-text);
            padding: 10px 20px; /* Standard padding là 20px */
            transition: all 0.2s ease;
            
            /* THÊM 2 DÒNG NÀY ĐỂ ICON VÀ CHỮ THẲNG HÀNG TUYỆT ĐỐI */
            display: flex;
            align-items: center;
        }
        .f1-dropdown-menu .dropdown-item:hover {
            background-color: var(--f1-red);
            color: white;
        }
        .f1-dropdown-menu .dropdown-divider {
            border-color: var(--bs-border-color);
        }

        /* Tính năng Hover để mở Menu (Chỉ áp dụng cho màn hình máy tính) */
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu { 
                display: none; 
                margin-top: 0; 
            }
            .navbar .nav-item:hover .dropdown-menu { 
                display: block; 
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top" style="z-index: 1050;">
        <div class="container">
            <a class="navbar-brand fs-2 fw-bold f1-font" href="/">
                <span>F1</span> NEWS
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh Mục
                        </a>
                        <ul class="dropdown-menu f1-dropdown-menu shadow-sm" aria-labelledby="navbarDropdown">
                            @foreach($globalCategories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category.show', $cat->slug) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                
                <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                    <input class="form-control me-2 border-secondary" 
                        type="search" 
                        name="query" 
                        placeholder="Tìm kiếm tin tức..." 
                        value="{{ request('query') }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <button type="button" onclick="toggleTheme()" class="btn btn-outline-secondary me-2" title="Toggle theme" aria-label="Toggle theme">
                    <i class="theme-toggle-icon fas fa-moon"></i>
                </button>
                
                @auth
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle f1-font px-3 d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 4px;">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 24px; height: 24px; object-fit: cover;">
                            @else
                                <i class="far fa-user me-1"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu f1-dropdown-menu dropdown-menu-end shadow-sm" style="border-top: 3px solid var(--f1-red) !important; margin-top: 15px;">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Trang cá nhân</a></li>
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Trang Quản Trị</a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-f1" style="min-width: 120px;">ĐĂNG NHẬP</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary f1-font" style="min-width: 120px; border-radius: 4px;">ĐĂNG KÝ</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container my-5 min-vh-100">
        @yield('content')
    </main>

    <footer class="bg-dark text-light border-top border-danger mt-5" style="border-width: 4px !important;">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Col 1: Brand -->
                <div class="col-lg-3 col-md-6">
                    <div class="mb-4">
                        <h5 class="f1-font fw-bold mb-3" style="color: var(--f1-red);">
                            <i class="fas fa-flag-checkered me-2"></i>F1 NEWS
                        </h5>
                        <p class="small text-secondary mb-0">
                            Trang tin tức thể thao tốc độ được phát triển như một dự án học tập Laravel MVC. Cập nhật tin tức F1 hàng ngày từ các giải đua quốc tế.
                        </p>
                    </div>
                </div>

                <!-- Col 2: Categories -->
                <div class="col-lg-3 col-md-6">
                    <div class="mb-4">
                        <h6 class="f1-font fw-bold mb-3" style="color: var(--f1-red);">
                            <i class="fas fa-list me-2"></i>DANH MỤC
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="/" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fas fa-newspaper me-2"></i>Tin Tức Mới Nhất
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="/" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fas fa-calendar-alt me-2"></i>Lịch Đua 2026
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="/" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fas fa-trophy me-2"></i>Bảng Xếp Hạng
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Col 3: Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <div class="mb-4">
                        <h6 class="f1-font fw-bold mb-3" style="color: var(--f1-red);">
                            <i class="fas fa-link me-2"></i>LIÊN KẾT NHANH
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="/" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fas fa-info-circle me-2"></i>Về Chúng Tôi
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="/" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fas fa-file-contract me-2"></i>Điều Khoản Sử Dụng
                                </a>
                            </li>
                            <li class="mb-2">
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                        <i class="fas fa-lock me-2"></i>Trang Quản Trị
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                        <i class="fas fa-lock me-2"></i>Đăng Nhập Admin
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Col 4: Contact -->
                <div class="col-lg-3 col-md-6">
                    <div class="mb-4">
                        <h6 class="f1-font fw-bold mb-3" style="color: var(--f1-red);">
                            <i class="fas fa-envelope me-2"></i>LIÊN HỆ
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2 text-light">
                                <i class="fas fa-map-marker-alt me-2" style="color: var(--f1-red);"></i>
                                <span>Hà Nội, Việt Nam</span>
                            </li>
                            <li class="mb-2">
                                <a href="mailto:admin@f1news.local" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fas fa-envelope me-2" style="color: var(--f1-red);"></i>admin@f1news.local
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="https://github.com" target="_blank" class="text-decoration-none text-light" style="transition: color 0.3s;">
                                    <i class="fab fa-github me-2" style="color: var(--f1-red);"></i>GitHub Repository
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Divider -->
            <hr class="border-secondary my-4">

            <!-- Bottom Bar -->
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-secondary small mb-1">
                        &copy; 2026 F1 News - WEBSITE TIN TỨC GIẢI ĐUA XE F1.
                    </p>
                    <p class="text-secondary small mb-0">
                        Sinh viên thực hiện: <span class="fw-bold" style="color: var(--f1-red);">Trương Việt Hoàng</span>
                    </p>
                </div>
            </div>
        </div>

        <style>
            footer a {
                color: inherit;
                transition: color 0.3s ease;
            }
            footer a:hover {
                color: var(--f1-red) !important;
            }
        </style>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            function applyTheme(theme) {
                document.documentElement.setAttribute('data-bs-theme', theme);
                document.querySelectorAll('.theme-toggle-icon').forEach(function (icon) {
                    icon.classList.toggle('fa-sun', theme === 'light');
                    icon.classList.toggle('fa-moon', theme !== 'light');
                });
            }

            var savedTheme = localStorage.getItem('theme') || 'dark';
            applyTheme(savedTheme);

            window.toggleTheme = function () {
                var currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'dark';
                var nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', nextTheme);
                applyTheme(nextTheme);
            };
        })();
    </script>
</body>
</html>