<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Sandikami')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            /* Warna yang diadaptasi dari style.css (Kominfo Blue) */
            --sidebar-bg: #004b87; /* --color-primary */
            --sidebar-hover: #005c9e; /* --color-primary-light */
            --sidebar-text: #e0f2fe; /* --color-text */
            --sidebar-active-bg: #006eb8; /* --color-primary-lighter */
            --main-bg: #001a33; /* --color-bg */
            --text-main: #e0f2fe; /* --color-text */
            --text-muted: #93c5fd; /* --color-text-muted */
            --card-bg: rgba(0, 75, 135, 0.3); /* Glass effect matching portal */
            --primary: #00a8e8; /* --color-secondary (sebagai highlight) */
            --border-color: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--main-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(0, 216, 255, 0.05), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(255, 193, 7, 0.05), transparent 25%);
            background-attachment: fixed;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            background-color: rgba(0, 75, 135, 0.6);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--border-color);
            color: var(--sidebar-text);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 25px 20px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand i {
            color: var(--primary);
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            flex-grow: 1;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover {
            background-color: var(--sidebar-hover);
            color: white;
            border-left: 4px solid var(--primary);
        }

        .sidebar-menu a.active {
            background-color: var(--sidebar-active-bg);
            color: white;
            border-left: 4px solid var(--primary);
        }

        .menu-heading {
            padding: 15px 25px 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
        }

        .sidebar-user {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--sidebar-active-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .sidebar-user-info div {
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
        }

        .sidebar-user-info small {
            color: rgba(255,255,255,0.7);
            font-size: 0.75rem;
        }

        /* Main Content */
        .admin-main {
            flex-grow: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-topbar {
            height: 70px;
            background-color: rgba(0, 26, 51, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-content {
            padding: 30px;
            flex-grow: 1;
        }

        /* Utilities */
        .card {
            background-color: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        
        .btn-primary { background-color: var(--sidebar-hover); color: white; border: 1px solid var(--primary); }
        .btn-primary:hover { background-color: var(--sidebar-active-bg); }
        .btn-secondary { background-color: rgba(255,255,255,0.1); color: var(--text-main); border: 1px solid var(--border-color); }
        .btn-secondary:hover { background-color: rgba(255,255,255,0.2); }
        .btn-danger { background-color: #EF4444; color: white; }

        .table { width: 100%; border-collapse: collapse; color: var(--text-main); }
        .table th, .table td { padding: 12px 15px; border-bottom: 1px solid var(--border-color); text-align: left; }
        .table th { font-weight: 600; color: var(--primary); background-color: rgba(0, 75, 135, 0.4); border-bottom: 2px solid var(--border-color); }
        .table tbody tr:hover { background-color: rgba(255, 255, 255, 0.05); }
        
        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            background-color: rgba(0, 0, 0, 0.2);
            color: var(--text-main);
            border-radius: 6px;
            font-family: inherit;
            margin-top: 5px;
            font-size: 0.95rem;
        }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 2px rgba(0, 168, 232, 0.2); }
        .form-control::placeholder { color: var(--text-muted); opacity: 0.5; }
        .form-label { font-weight: 600; font-size: 0.9rem; color: var(--text-muted); }
        .form-group { margin-bottom: 20px; }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .alert-success { background-color: rgba(16, 185, 129, 0.1); color: #10B981; border-color: rgba(16, 185, 129, 0.2); }

    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <i class="ri-shield-keyhole-fill"></i> Sandikami
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-heading">Utama</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ri-dashboard-line"></i> Admin Dashboard
                </a>
            </li>

            <li class="menu-heading">Layanan & Pengaduan</li>
            <li>
                <a href="{{ route('admin.layanan.index') }}" class="{{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                    <i class="ri-file-list-3-line"></i> Pantau Pengajuan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengaduan.index') }}" class="{{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    <i class="ri-feedback-line"></i> Laporan Pengaduan
                </a>
            </li>

            <li class="menu-heading">Manajemen Konten (CMS)</li>
            <li>
                <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="ri-article-line"></i> Kelola Berita
                </a>
            </li>
            <li>
                <a href="{{ route('admin.katalog.index') }}" class="{{ request()->routeIs('admin.katalog.*') ? 'active' : '' }}">
                    <i class="ri-list-check-2"></i> Katalog Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profil.index') }}" class="{{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                    <i class="ri-pages-line"></i> Edit Profil Web
                </a>
            </li>

            <li class="menu-heading">Akun</li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();" style="color: #e74c3c;">
                    <i class="ri-logout-box-line"></i> Keluar (Log Out)
                </a>
                <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="sidebar-user-info">
                <div>{{ auth()->user()->name ?? 'Administrator' }}</div>
                <small>SUPER ADMIN</small>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-title">@yield('page_title', 'Panel Kontrol Administrator')</div>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary"><i class="ri-external-link-line mr-1"></i> Lihat Portal</a>
            </div>
        </header>

        <div class="admin-content">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
