<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Mazer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #435ebe;
            --secondary-color: #56ccf2;
            --sidebar-bg: #1e1e2d;
            --sidebar-text: #a2a3b7;
        }
        
        body {
            background-color: #f2f7ff;
            font-family: 'Nunito', sans-serif;
        }
        
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #1e1e2d 0%, #151521 100%);
            z-index: 1000;
            transition: all 0.3s;
        }
        
        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand h4 {
            color: #fff;
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .sidebar-menu .menu-title {
            color: #6e6b7b;
            font-size: 12px;
            text-transform: uppercase;
            padding: 10px 25px;
            letter-spacing: 1px;
        }
        
        .sidebar-menu .nav-link {
            color: var(--sidebar-text);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu .nav-link:hover,
        .sidebar-menu .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.05);
            border-left-color: var(--primary-color);
        }
        
        .sidebar-menu .nav-link i {
            margin-right: 12px;
            font-size: 18px;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }
        
        .topbar {
            background: #fff;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .topbar h4 {
            margin: 0;
            color: #333;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            border-radius: 15px;
            padding: 20px;
        }
        
        .stat-card.purple {
            background: linear-gradient(135deg, #7367f0, #ce9ffc);
        }
        
        .stat-card.green {
            background: linear-gradient(135deg, #28c76f, #81fbb8);
        }
        
        .stat-card.orange {
            background: linear-gradient(135deg, #ff9f43, #ffcd74);
        }
        
        .stat-card.red {
            background: linear-gradient(135deg, #ea5455, #f8a5a5);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background: #364fc7;
            border-color: #364fc7;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #6e6b7b;
        }
        
        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .user-dropdown .dropdown-toggle::after {
            display: none;
        }
        
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-book"></i> Perpustakaan</h4>
        </div>
        
        <nav class="sidebar-menu">
            <span class="menu-title">Menu Utama</span>
            
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
            
            @if(auth()->user()->role !== 'member')
            <span class="menu-title mt-3">Manajemen Data</span>
            
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-folder"></i>
                <span>Kategori</span>
            </a>
            
            <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                <span>Buku</span>
            </a>
            
            <a href="{{ route('members.index') }}" class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Anggota</span>
            </a>
            
            <span class="menu-title mt-3">Transaksi</span>
            
            <a href="{{ route('loans.index') }}" class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i>
                <span>Peminjaman</span>
            </a>
            @endif
        </nav>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div>
                <h4>@yield('title', 'Dashboard')</h4>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <div class="me-2 text-end">
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
                        </div>
                        <div class="avatar">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <!-- Page Content -->
        @yield('content')
    </main>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
