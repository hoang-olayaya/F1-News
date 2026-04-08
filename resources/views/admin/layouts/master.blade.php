<!DOCTYPE html>
<html lang="vi" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - F1 News')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <style>
        /* F1 Dark Theme Customizations for AdminLTE */
        .btn-primary { background-color: #e10600 !important; border-color: #e10600 !important; color: white !important; }
        .btn-primary:hover { background-color: #b30500 !important; border-color: #b30500 !important; }
        .card-primary.card-outline { border-top-color: #e10600 !important; }
        .sidebar-dark-primary { background-color: #15151e !important; }
        .nav-pills .nav-link.active { background-color: #e10600 !important; color: white !important; }
        .page-item.active .page-link { background-color: #e10600 !important; border-color: #e10600 !important; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">@yield('page-title')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
                
            </div>
        </div>
    </main>

    @include('admin.layouts.footer')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
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