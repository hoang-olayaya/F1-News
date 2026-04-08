<!DOCTYPE html>
<html lang="vi" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'F1 News - Thể Thao Tốc Độ')</title>
    
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
                        <a class="btn btn-outline-secondary dropdown-toggle f1-font px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 4px;">
                            <i class="far fa-user me-1"></i> {{ Auth::user()->name }}
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

    <footer class="text-center py-4 text-muted">
        <div class="container">
            <p class="mb-1">&copy; 2026 F1 News - Đồ án Website Thể Thao Tốc Độ.</p>
            <p class="mb-0">Sinh viên thực hiện: Hoàng</p>
        </div>
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