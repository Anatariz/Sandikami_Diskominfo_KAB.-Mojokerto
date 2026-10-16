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

    <!-- Dark Mode Inline Script (Prevents White Flash) -->
    <script>
      (function() {
        var savedTheme = localStorage.getItem('sandikami_theme');
        var systemDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (savedTheme === 'dark' || (!savedTheme && systemDark)) {
          document.documentElement.setAttribute('data-theme', 'dark');
        } else {
          document.documentElement.setAttribute('data-theme', 'light');
        }
      })();
    </script>
    <style>
        :root {
            /* Tema Biru & Putih (Blue & White Theme) */
            --sidebar-bg: #003e73; /* Rich Kominfo Deep Blue */
            --sidebar-hover: #005299; 
            --sidebar-text: #e0f2fe; 
            --sidebar-active-bg: #0062b8; 
            --main-bg: #f4f7fb; /* Clean Soft Light Background */
            --text-main: #0f172a; /* Slate 900 for clear readability */
            --text-muted: #64748b; /* Slate 500 */
            --card-bg: #ffffff; /* Pure White Card */
            --primary: #004b87; /* Kominfo Blue */
            --border-color: #bae6fd; /* Soft Sky Blue (Biru Muda / Biru Langit) */
            --border-sky: #7dd3fc; /* Sky Blue 300 */
            --border-light-blue: #93c5fd; /* Light Blue 300 */
            --input-border: #93c5fd; /* Input Border Biru Langit */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scrollbar-gutter: stable;
        }

        body {
            background-color: var(--main-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            background-image: 
                radial-gradient(circle at 12% 20%, rgba(0, 102, 204, 0.04), transparent 28%),
                radial-gradient(circle at 88% 40%, rgba(2, 132, 199, 0.03), transparent 28%);
            background-attachment: fixed;
        }

        .admin-sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--sidebar-text);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 2px 0 12px rgba(0, 75, 135, 0.08);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body.sidebar-hidden .admin-sidebar {
            transform: translateX(-100%);
        }

        .sidebar-toggle-btn {
            position: fixed;
            top: 90px;
            left: 0;
            background-color: var(--primary);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 0 25px 25px 0;
            cursor: pointer;
            z-index: 99;
            box-shadow: 2px 2px 10px rgba(0, 75, 135, 0.2);
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
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
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
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .sidebar-brand {
            padding: 25px 20px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar-brand i {
            color: #7dd3fc;
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
            border-left: 4px solid #7dd3fc;
        }

        .sidebar-menu a.active {
            background-color: var(--sidebar-active-bg);
            color: white;
            border-left: 4px solid #7dd3fc;
        }

        .menu-heading {
            padding: 15px 25px 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.6);
            font-weight: 600;
        }

        .sidebar-user {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
        }    

        .sidebar-user-info div {
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
        }

        .sidebar-user-info small {
            color: #bae6fd;
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
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 1px 4px rgba(0, 75, 135, 0.05);
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
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 75, 135, 0.05);
            border: 1.5px solid var(--border-color);
            padding: 30px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        
        .btn-primary { 
            background-color: var(--primary); 
            color: white; 
            border: 1.5px solid var(--primary); 
        }
        .btn-primary:hover { 
            background-color: #003666; 
            border-color: #003666;
        }
        .btn-secondary { 
            background-color: #ffffff; 
            color: var(--primary); 
            border: 1.5px solid var(--input-border); 
        }
        .btn-secondary:hover { 
            background-color: #f0f9ff; 
            border-color: var(--border-sky); 
            color: #0284c7;
        }
        .btn-danger { background-color: #EF4444; color: white; }

        /* Admin Filter Card (Sky Blue / Light Blue Theme) */
        .admin-filter-card {
            margin-bottom: 22px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
            background-color: #ffffff;
            padding: 16px 20px;
            border-radius: 12px;
            border: 1.5px solid var(--input-border);
            box-shadow: 0 4px 18px rgba(147, 197, 253, 0.18);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .admin-filter-card:hover {
            border-color: var(--border-sky);
            box-shadow: 0 6px 22px rgba(147, 197, 253, 0.25);
        }
        .admin-filter-card label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
            display: block;
        }
        .admin-filter-card .form-control {
            margin-top: 0;
            padding: 9px 12px;
            border: 1.5px solid var(--input-border);
            border-radius: 8px;
            background-color: #ffffff;
            color: var(--text-main);
        }
        .admin-filter-card .form-control:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
        }

        /* Admin Tables - Light Blue Slightly Transparent Theme */
        .card:has(.table), .card.p-0 {
            background-color: rgba(240, 247, 255, 0.75);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(147, 197, 253, 0.85);
            box-shadow: 0 4px 18px rgba(0, 75, 135, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        .table { 
            width: 100%; 
            border-collapse: collapse; 
            color: var(--text-main); 
            background-color: rgba(240, 247, 255, 0.65); 
        }
        
        .table th, .table td { 
            padding: 13px 16px; 
            border-bottom: 1px solid rgba(191, 219, 254, 0.65); 
            text-align: left; 
        }
        
        .table thead tr, .table th { 
            font-weight: 700; 
            color: var(--primary); 
            background-color: rgba(219, 234, 254, 0.85) !important; 
            border-bottom: 2px solid rgba(147, 197, 253, 0.85); 
        }
        
        .table tbody tr {
            background-color: rgba(255, 255, 255, 0.45);
            transition: background-color 0.2s ease;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: rgba(224, 242, 254, 0.35);
        }
        
        .table tbody tr:hover { 
            background-color: rgba(186, 230, 253, 0.6) !important; 
        }
        
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--input-border);
            background-color: #ffffff;
            color: var(--text-main);
            border-radius: 8px;
            font-family: inherit;
            margin-top: 5px;
            font-size: 0.95rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-control:focus { outline: none; border-color: #0284c7; box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25); }
        .form-control::placeholder { color: var(--text-muted); opacity: 0.7; }
        
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23004b87' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: calc(100% - 12px) center;
            background-size: 14px 14px;
            padding-right: 36px;
            cursor: pointer;
        }

        .form-label { font-weight: 600; font-size: 0.9rem; color: #1e293b; }
        .form-group { margin-bottom: 20px; }

        /* Form Builder Dynamic Field Items (Blue & Gradient on Hover/Typing) */
        .field-item {
            background-color: #f0f7ff;
            padding: 18px 20px;
            border-radius: 12px;
            margin-bottom: 16px;
            border: 1.5px solid #bae6fd;
            position: relative;
            box-shadow: 0 2px 8px rgba(186, 230, 253, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .field-item:hover {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #dbeafe 100%);
            border-color: #7dd3fc;
            box-shadow: 0 8px 24px rgba(56, 189, 248, 0.22);
            transform: translateY(-2px);
        }

        .field-item:focus-within {
            background: linear-gradient(135deg, #dbeafe 0%, #bae6fd 45%, #e0f2fe 100%);
            border-color: #0284c7;
            box-shadow: 0 10px 28px rgba(2, 132, 199, 0.25);
            transform: translateY(-2px);
        }

        .field-item label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            display: block;
            margin-bottom: 6px;
            transition: color 0.2s ease;
        }

        .field-item:hover label,
        .field-item:focus-within label {
            color: #0369a1;
        }

        .field-item .form-control {
            background-color: #ffffff;
            border: 1.5px solid #93c5fd;
            border-radius: 8px;
            color: var(--text-main);
            transition: all 0.2s ease;
        }

        .field-item .form-control:focus {
            background-color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 3.5px rgba(56, 189, 248, 0.3);
        }

        .field-item .btn-remove-field {
            position: absolute;
            right: 12px;
            top: 12px;
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: 1.3rem;
            line-height: 1;
            opacity: 0.75;
            transition: transform 0.2s ease, opacity 0.2s ease, color 0.2s ease;
        }

        .field-item .btn-remove-field:hover {
            opacity: 1;
            color: #dc2626;
            transform: scale(1.18);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .alert-success { background-color: #ecfdf5; color: #065f46; border-color: #a7f3d0; }

        /* File Input Custom */
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
            z-index: 10;
        }
        .file-upload-display {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px dashed #93c5fd;
            border-radius: 6px;
            background-color: #f8fafc;
            text-align: center;
            transition: all 0.2s;
            color: var(--text-muted);
        }
        .file-upload-wrapper:hover .file-upload-display,
        .file-upload-wrapper.dragover .file-upload-display {
            border-color: var(--primary);
            background-color: #f0f7ff;
            color: var(--primary);
        }

        /* Ikon Akun / Profil Topbar (gaya sama dengan tombol tema) */
        .topbar-actions .admin-profile-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            flex-shrink: 0;
            background: rgba(0, 75, 135, 0.08);
            border: 1.5px solid rgba(0, 75, 135, 0.25);
            color: var(--primary);
            font-size: 1.25rem;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 75, 135, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .topbar-actions .admin-profile-btn:hover {
            border-color: var(--primary);
            transform: scale(1.08);
            box-shadow: 0 4px 14px rgba(0, 75, 135, 0.2);
        }
        .topbar-actions .admin-profile-btn img { width: 100%; height: 100%; object-fit: cover; }
        [data-theme="dark"] .topbar-actions .admin-profile-btn {
            background: rgba(56, 189, 248, 0.12);
            border-color: rgba(56, 189, 248, 0.35);
            color: #38bdf8;
            box-shadow: 0 0 14px rgba(56, 189, 248, 0.25);
        }
        [data-theme="dark"] .topbar-actions .admin-profile-btn:hover {
            background: rgba(56, 189, 248, 0.22);
            border-color: #38bdf8;
            color: #38bdf8;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.45);
        }

        /* Dropdown Akun (mengikuti dropdown profil portal) */
        .admin-dropdown { position: relative; display: inline-flex; align-items: center; }
        .topbar-actions .admin-dropdown-toggle { cursor: pointer; padding: 0; font-family: inherit; }
        .admin-dropdown-content {
            position: absolute;
            top: 100%;
            right: 0;
            width: 280px;
            margin-top: 15px;
            padding: 15px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 75, 135, 0.12);
            z-index: 1050;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .admin-dropdown.open .admin-dropdown-content {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
        .admin-dropdown-header {
            display: flex;
            gap: 15px;
            align-items: center;
            padding-bottom: 15px;
            margin-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }
        .admin-dropdown-avatar {
            width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            background-color: #e0effe; border: 1.5px solid #bfdbfe;
            color: var(--primary); font-size: 1.3rem;
        }
        .admin-dropdown-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .admin-dropdown-meta { overflow: hidden; }
        .admin-dropdown-name { font-weight: 600; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-dropdown-email { font-size: 0.8rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-dropdown-item {
            display: flex; align-items: center; gap: 10px; width: 100%;
            padding: 10px; margin-bottom: 5px; border-radius: 6px; border: none; background: none;
            color: var(--text-main); font-family: inherit; font-size: inherit; font-weight: 500;
            text-align: left; text-decoration: none; cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }
        .admin-dropdown-item:hover { background: #f0f7ff; color: var(--primary); }
        .admin-dropdown-item.is-danger { color: #ef4444; margin-bottom: 0; }
        .admin-dropdown-item.is-danger:hover { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        [data-theme="dark"] .admin-dropdown-content { background: #131d33 !important; border-color: #1e2e4a !important; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.6) !important; }
        [data-theme="dark"] .admin-dropdown-avatar { background-color: #e0effe; border-color: #bfdbfe; color: #38bdf8; }
        [data-theme="dark"] .admin-dropdown-content .admin-dropdown-name { color: #f8fafc !important; }
        [data-theme="dark"] .admin-dropdown-content .admin-dropdown-item { color: #e2e8f0 !important; }
        [data-theme="dark"] .admin-dropdown-content .admin-dropdown-item:hover { background: #1a2744 !important; color: #38bdf8 !important; }
        [data-theme="dark"] .admin-dropdown-content .admin-dropdown-item.is-danger { color: #f87171 !important; }
        [data-theme="dark"] .admin-dropdown-content .admin-dropdown-item.is-danger:hover { background: rgba(239, 68, 68, 0.12) !important; color: #f87171 !important; }
        [data-theme="dark"] .topbar-actions .admin-dropdown-toggle { background: rgba(56, 189, 248, 0.12) !important; border-color: rgba(56, 189, 248, 0.35) !important; color: #38bdf8 !important; }
        [data-theme="dark"] .topbar-actions .admin-dropdown-toggle:hover,
        [data-theme="dark"] .admin-dropdown.open .admin-dropdown-toggle { background: rgba(56, 189, 248, 0.22) !important; border-color: #38bdf8 !important; }

        /* Pagination */
        .pagination { display: flex; flex-wrap: wrap; list-style: none; padding: 0; margin: 0; gap: 5px; align-items: center; justify-content: center; }
        .pagination .page-item .page-link { display: flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 10px; border-radius: 8px; background: #ffffff; color: var(--text-main); text-decoration: none; border: 1px solid var(--border-color); transition: all 0.3s ease; font-size: 0.9rem; }
        .pagination .page-item:not(.disabled):not(.active) .page-link:hover { background: #f0f7ff; border-color: #bfdbfe; color: var(--primary); }
        .pagination .page-item.active .page-link { background: var(--primary); color: white; border-color: var(--primary); font-weight: 600; }
        .pagination .page-item.disabled .page-link { opacity: 0.4; cursor: not-allowed; background: transparent; }
        .d-sm-none { display: none !important; } /* Hide bootstrap mobile view */
        .d-none.d-sm-flex { display: flex !important; flex-direction: column; gap: 15px; align-items: center; width: 100%; } /* Style the container */
        nav p.small.text-muted { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 10px; text-align: center; } /* Style the 'Showing x to y' text */
        nav p.small.text-muted .fw-semibold { font-weight: 700; color: #0f172a; }

    </style>
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}?v={{ filemtime(public_path('css/dark-mode.css')) }}">
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

            <li class="menu-heading">Manajemen Layanan & Konten</li>
            <li>
                <a href="{{ route('admin.katalog.index') }}" class="{{ request()->routeIs('admin.katalog.*') ? 'active' : '' }}">
                    <i class="ri-list-check-2"></i> Katalog Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="ri-newspaper-line"></i> Kelola Berita
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
                <a href="{{ route('home') }}" target="_self" class="btn btn-secondary"><i class="ri-global-line mr-1"></i> Lihat Portal</a>

                <!-- Dark Mode Toggle -->
                <button type="button" class="theme-toggle-btn" aria-label="Ganti Mode Gelap / Terang" title="Ganti Mode Gelap / Terang">
                    <i class="ri-moon-line theme-icon-moon"></i>
                    <i class="ri-sun-line theme-icon-sun"></i>
                </button>

                <!-- Ikon Akun / Profil + Dropdown (klik untuk membuka) -->
                <div class="admin-dropdown">
                    <button type="button" id="admin-profile-toggle" class="admin-profile-btn admin-dropdown-toggle" title="{{ auth()->user()->name }}" aria-label="Menu Akun" aria-haspopup="true">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar {{ auth()->user()->name }}">
                        @else
                            <i class="ri-user-fill"></i>
                        @endif
                    </button>

                    <div class="admin-dropdown-content" role="menu">
                        <div class="admin-dropdown-header">
                            <div class="admin-dropdown-avatar">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar {{ auth()->user()->name }}">
                                @else
                                    <i class="ri-user-fill"></i>
                                @endif
                            </div>
                            <div class="admin-dropdown-meta">
                                <div class="admin-dropdown-name">{{ auth()->user()->name }}</div>
                                <div class="admin-dropdown-email">{{ auth()->user()->email }}</div>
                            </div>
                        </div>

                        <a href="{{ route('profile.show') }}" id="admin-menu-akun" class="admin-dropdown-item" role="menuitem">
                            <i class="ri-user-settings-line"></i> Lihat Akun
                        </a>

                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" id="admin-menu-logout" class="admin-dropdown-item is-danger" role="menuitem">
                                <i class="ri-logout-box-line"></i> Logout
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

    <script src="{{ asset('js/theme.js') }}?v={{ filemtime(public_path('js/theme.js')) }}"></script>
    @stack('scripts')
</body>
</html>
