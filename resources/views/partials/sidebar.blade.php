<aside class="sidebar">
    <div class="sidebar-brand">
        <h2>Inventaris Lab</h2>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="@if (Route::currentRouteName() == 'dashboard') active @endif">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 10.5L12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-10.5Z" />
                    </svg>
                </span>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('inventaris.index') }}" class="@if (str_starts_with(Route::currentRouteName(), 'inventaris')) active @endif">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 7h16v14H4V7Zm0-4h16v2H4V3Zm2 8h4v4H6v-4Zm6 0h6v4h-6v-4Z" />
                    </svg>
                </span>
                <span>Inventaris</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kategori.index') }}" class="@if (str_starts_with(Route::currentRouteName(), 'kategori')) active @endif">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 4h16v4H4V4Zm0 6h8v4H4v-4Zm0 6h16v4H4v-4Z" />
                    </svg>
                </span>
                <span>Kategori</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kondisi.index') }}" class="@if (str_starts_with(Route::currentRouteName(), 'kondisi')) active @endif">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2a7 7 0 0 0-7 7c0 3.87 3.13 7 7 7s7-3.13 7-7a7 7 0 0 0-7-7Zm0 14c-3.31 0-6-2.69-6-6a6 6 0 0 1 12 0c0 3.31-2.69 6-6 6Z" />
                        <path d="M12 7.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                    </svg>
                </span>
                <span>Kondisi</span>
            </a>
        </li>
    </ul>
</aside>
