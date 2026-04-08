<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"> 
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="fas fa-bars"></i> </a> 
            </li>
            <li class="nav-item d-none d-md-block"> 
                <a href="#" class="nav-link">F1 NEWS</a> 
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <button type="button" onclick="toggleTheme()" class="nav-link border-0 bg-transparent" title="Toggle theme" aria-label="Toggle theme">
                    <i class="theme-toggle-icon fas fa-moon"></i>
                </button>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link" title="View Homepage">
                    <i class="fas fa-globe"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>