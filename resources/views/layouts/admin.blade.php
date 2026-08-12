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
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.sidebar-hidden .admin-sidebar {
            transform: translateX(-100%);
        }

        .sidebar-toggle-btn {
            position: fixed;
            top: 90px;
            left: 0;
            background-color: var(--primary); /* Menggunakan warna aksen tema (biru) */
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 0 25px 25px 0;
            cursor: pointer;
            z-index: 99;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        body:not(.sidebar-hidden) .sidebar-toggle-btn {
            opacity: 0;
            pointer-events: none;
            transform: translateX(-100%);
        }

        .sidebar-close-btn {
            position: absolute;
            top: 20px;
            right: 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            z-index: 101;
        }

        .sidebar-close-btn:hover {
            background: rgba(16, 40, 202, 0.2);
            color: #2117d7ff;
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
            width: 48px;
            height: 48px;
            background-color: var(--color-primary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 168, 232, 0.3);
            overflow: hidden;
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
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.sidebar-hidden .admin-main {
            margin-left: 0;
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
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Utilities */
        .card {
            background-color: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
            padding: 30px;
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

        /* Dropdown */
        .admin-dropdown { position: relative; display: inline-flex; align-items: center; }
        .admin-dropdown-content {
            display: none; position: absolute; top: 100%; right: 0; background-color: var(--sidebar-hover);
            min-width: 280px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); z-index: 100; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); padding: 15px; margin-top: 10px;
        }
        .admin-dropdown:hover .admin-dropdown-content,
        .admin-dropdown:focus-within .admin-dropdown-content { display: block; }
        /* Pagination */
        .pagination { display: flex; flex-wrap: wrap; list-style: none; padding: 0; margin: 0; gap: 5px; align-items: center; justify-content: center; }
        .pagination .page-item .page-link { display: flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 10px; border-radius: 8px; background: rgba(255, 255, 255, 0.05); color: var(--text-main); text-decoration: none; border: 1px solid var(--border-color); transition: all 0.3s ease; font-size: 0.9rem; }
        .pagination .page-item:not(.disabled):not(.active) .page-link:hover { background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); color: white; }
        .pagination .page-item.active .page-link { background: var(--primary); color: white; border-color: var(--primary); font-weight: 600; }
        .pagination .page-item.disabled .page-link { opacity: 0.4; cursor: not-allowed; background: transparent; }
        .d-sm-none { display: none !important; } /* Hide bootstrap mobile view */
        .d-none.d-sm-flex { display: flex !important; flex-direction: column; gap: 15px; align-items: center; width: 100%; } /* Style the container */
        nav p.small.text-muted { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 10px; text-align: center; } /* Style the 'Showing x to y' text */
        nav p.small.text-muted .fw-semibold { font-weight: 700; color: white; }

    </style>
    @stack('styles')
</head>
<body>
    @if(!request()->routeIs('profile.*'))
    <!-- Toggle Button for Hidden Sidebar -->
    <button id="sidebar-toggle" class="sidebar-toggle-btn" onclick="document.body.classList.toggle('sidebar-hidden')">
        <i class="ri-menu-line"></i>
    </button>
    @endif

    <!-- Sidebar -->
    @if(!request()->routeIs('profile.*'))
    <aside class="admin-sidebar">
        <!-- Close Button for Sidebar -->
        <button id="sidebar-close" class="sidebar-close-btn" onclick="document.body.classList.toggle('sidebar-hidden')">
            <i class="ri-close-line"></i>
        </button>

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
                <a href="{{ route('admin.katalog.index') }}" class="{{ request()->routeIs('admin.katalog.*') ? 'active' : '' }}">
                    <i class="ri-list-check-2"></i> Katalog Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profil.index') }}" class="{{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                    <i class="ri-pages-line"></i> Edit Profil Web
                </a>
            </li>
            <li>
                <a href="{{ route('admin.panduan.index') }}" class="{{ request()->routeIs('admin.panduan.*') ? 'active' : '' }}">
                    <i class="ri-book-read-line"></i> Edit Panduan
                </a>
            </li>


        </ul>

    </aside>
    @endif

    <!-- Main Content -->
    <main class="admin-main" style="{{ request()->routeIs('profile.*') ? 'margin-left: 0;' : '' }}">
        @if(!request()->routeIs('profile.*'))
        <header class="admin-topbar">
            <div class="topbar-title">@yield('page_title', 'Panel Kontrol Administrator')</div>
            <div class="topbar-actions" style="display: flex; align-items: center; gap: 15px;">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary"><i class="ri-external-link-line mr-1"></i> Lihat Portal</a>

                <div class="admin-dropdown">
                    <a href="#" style="color: white; text-decoration: none; width: 40px; height: 40px; background-color: var(--primary); border-radius: 50%; display: flex; justify-content: center; align-items: center; overflow: hidden; border: 2px solid rgba(255,255,255,0.2);">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="ri-user-fill" style="font-size: 1.2rem;"></i>
                        @endif
                    </a>
                    
                    <div class="admin-dropdown-content">
                        <!-- Profile Info -->
                        <div style="display: flex; gap: 15px; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; margin-bottom: 10px;">
                            <div style="width: 50px; height: 50px; background-color: var(--primary); border-radius: 50%; overflow: hidden; display: flex; justify-content: center; align-items: center; flex-shrink: 0; border: 2px solid rgba(255,255,255,0.2);">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="ri-user-fill" style="color: white; font-size: 1.5rem;"></i>
                                @endif
                            </div>
                            <div style="overflow: hidden; color: white;">
                                <div style="font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ auth()->user()->name }}</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <a href="{{ route('profile.show') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: 6px; margin-bottom: 5px; color: white; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='rgba(0, 216, 255, 0.1)'" onmouseout="this.style.backgroundColor='transparent'">
                            <i class="ri-user-settings-line"></i> Profil Akun
                        </a>
                        
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: #ef4444; padding: 10px; border-radius: 6px; font-family: inherit; font-size: inherit; transition: background 0.2s;" onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.1)'" onmouseout="this.style.backgroundColor='transparent'">
                                <i class="ri-logout-box-line"></i> Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        @endif

        <div class="admin-content" style="{{ request()->routeIs('profile.*') ? 'display: flex; flex-direction: column; min-height: 100vh; padding: 60px 20px;' : '' }}">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
