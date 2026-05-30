<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LabInvent — Sistem Inventaris Laboratorium')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="app-shell">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('inventaris.index') }}" class="brand-logo">
                <div class="brand-icon">Lab</div>
                <div>
                    <div class="brand-title">LabInvent</div>
                    <div class="brand-subtitle">Inventory</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor"
                        d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6zm2-10h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
                </svg>

                <span>Dashboard</span>
            </a>
            <div class="nav-group-title">Main Menu</div>
            <a href="{{ route('inventaris.index') }}"
                class="nav-link {{ request()->routeIs('inventaris.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8-4m0 0v10l-8 4M9 5l8 4"></path>
                </svg>
                <span>Inventory Items</span>
            </a>
            <a href="{{ route('kategori.index') }}"
                class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                </svg>
                <span>Categories</span>
            </a>
            <a href="{{ route('kondisi.index') }}"
                class="nav-link {{ request()->routeIs('kondisi.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Conditions</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-version">LabInvent v1.0</div>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-wrap">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-left">
                    <button id="sidebarToggle" class="topbar-toggle" type="button" aria-label="Toggle sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="topbar-brand">LabInvent</div>
                    <div class="topbar-breadcrumb">
                        <span>Home</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="current">@yield('breadcrumb', 'Dashboard')</span>
                    </div>
                </div>
                <div class="topbar-actions">
                    <button class="topbar-action-btn" type="button" aria-label="Notifications">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z"></path>
                        </svg>
                    </button>
                    <div class="profile-pill">
                        <div class="profile-avatar">A</div>
                        <div>
                            <p class="profile-name">Admin</p>
                            <p class="profile-role">Lab Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @include('partials.navbar')

        {{-- CONTENT --}}
        <main class="page-content">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="footer">
            <p>&copy; 2024 LabInvent. Politeknik Takumi.</p>
        </footer>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebarToggle');

        toggleButton?.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-open');
        });

        // Close sidebar when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    sidebar.classList.remove('sidebar-open');
                }
            });
        });
    </script>

</body>

</html>