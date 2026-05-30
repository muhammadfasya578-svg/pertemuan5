@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="dashboard-header">
    <div>
        <p class="eyebrow">Dashboard</p>
        <h1 class="page-title">Inventaris Laboratorium</h1>
        <p class="page-subtitle">Ringkasan data inventaris secara real-time dengan tampilan modern, rapi, dan profesional.</p>
    </div>
    <div class="dashboard-actions">
        <a href="{{ route('inventaris.create') }}" class="btn btn-primary btn-lg">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 5v14" />
                <path d="M5 12h14" />
            </svg>
            Tambah Inventaris
        </a>
    </div>
</div>

<div class="dashboard-grid">
    <article class="dashboard-stat-card">
        <div class="stat-meta">
            <span class="stat-title">Total Inventaris</span>
            <span class="stat-pill">Items</span>
        </div>
        <h2 class="stat-value">{{ number_format($totalInventaris) }}</h2>
        <p class="stat-desc">Total barang yang telah tercatat di sistem.</p>
    </article>
    <article class="dashboard-stat-card">
        <div class="stat-meta">
            <span class="stat-title">Total Kategori</span>
            <span class="stat-pill">Kategori</span>
        </div>
        <h2 class="stat-value">{{ number_format($totalKategori) }}</h2>
        <p class="stat-desc">Jumlah kategori inventaris yang digunakan.</p>
    </article>
    <article class="dashboard-stat-card">
        <div class="stat-meta">
            <span class="stat-title">Jenis Kondisi</span>
            <span class="stat-pill">Status</span>
        </div>
        <h2 class="stat-value">{{ number_format($totalKondisi) }}</h2>
        <p class="stat-desc">Status kondisi item yang tersedia.</p>
    </article>
    <article class="dashboard-stat-card">
        <div class="stat-meta">
            <span class="stat-title">Total Stok</span>
            <span class="stat-pill">Unit</span>
        </div>
        <h2 class="stat-value">{{ number_format($totalStock) }}</h2>
        <p class="stat-desc">Total jumlah unit dari semua inventaris.</p>
    </article>
</div>

<div class="charts-grid">
    <section class="chart-card">
        <div class="card-header">
            <div>
                <p class="chart-label">Inventaris per Kategori</p>
                <h2 class="chart-title">Distribusi kategori</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-frame">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </section>
    <section class="chart-card">
        <div class="card-header">
            <div>
                <p class="chart-label">Kondisi Barang</p>
                <h2 class="chart-title">Status kondisi</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-frame">
                <canvas id="conditionChart"></canvas>
            </div>
        </div>
    </section>
    <section class="chart-card">
        <div class="card-header">
            <div>
                <p class="chart-label">Pengadaan Per Bulan</p>
                <h2 class="chart-title">Trend masuk barang</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-frame">
                <canvas id="acquisitionChart"></canvas>
            </div>
        </div>
    </section>
    <section class="chart-card">
        <div class="card-header">
            <div>
                <p class="chart-label">Stok per Kategori</p>
                <h2 class="chart-title">Jumlah unit</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-frame">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
    </section>
</div>

<div class="card mt-6">
    <div class="card-header card-header-flex">
        <div>
            <p class="chart-label">Barang Terbaru</p>
            <h2 class="chart-title">5 item terakhir</h2>
        </div>
        <div class="table-toolbar">
            <div class="search-box">
                <span class="search-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="M21 21l-4.35-4.35"></path>
                    </svg>
                </span>
                <input id="inventorySearch" type="search" placeholder="Cari item..." class="table-search" />
            </div>
            <select id="conditionFilter" class="table-filter">
                <option value="all">Semua Kondisi</option>
                @foreach ($kondisiStats as $kondisi)
                    <option value="{{ strtolower($kondisi->nama) }}">{{ $kondisi->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body">
        @if ($barangTerbaru->isEmpty())
            <div class="empty-state modern-empty-state">
                <div class="empty-state-title">Belum Ada Item</div>
                <p class="empty-state-text">Tambahkan inventaris baru untuk mulai mendapatkan insight.</p>
                <a href="{{ route('inventaris.create') }}" class="btn btn-primary">Tambah Item</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="modern-table" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Item</th>
                            <th>Kategori</th>
                            <th>Kondisi</th>
                            <th>Stok</th>
                            <th>Ditambahkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangTerbaru as $item)
                            <tr data-condition="{{ strtolower($item->kondisi->nama ?? '') }}" data-search="{{ strtolower($item->kode_barang . ' ' . $item->nama_barang . ' ' . $item->kategori->nama) }}">
                                <td><strong>{{ $item->kode_barang }}</strong></td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td><span class="badge badge-{{ $item->kondisi->badge_color ?? 'gray' }}">{{ $item->kondisi->nama ?? 'Tidak tersedia' }}</span></td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('inventaris.show', $item) }}" class="btn btn-ghost btn-sm">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const categoryLabels = @json($categoryStats->pluck('nama'));
    const categoryData = @json($categoryStats->pluck('inventaris_count'));
    const conditionLabels = @json($kondisiStats->pluck('nama'));
    const conditionData = @json($kondisiStats->pluck('inventaris_count'));
    const monthLabels = @json($monthlyAcquisitions->pluck('month'));
    const monthData = @json($monthlyAcquisitions->pluck('count'));
    const stockCategoryLabels = @json($stockByCategory->pluck('nama'));
    const stockCategoryData = @json($stockByCategory->pluck('inventaris_sum_jumlah'));

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { labels: { color: '#475569', padding: 16, usePointStyle: true } },
            tooltip: { backgroundColor: '#0f172a', titleColor: '#fff', bodyColor: '#e2e8f0', cornerRadius: 12, padding: 12 }
        },
        scales: {
            x: { ticks: { color: '#475569' }, grid: { color: 'rgba(148,163,184,0.18)' } },
            y: { ticks: { color: '#475569' }, grid: { color: 'rgba(148,163,184,0.18)' } }
        }
    };

    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Jumlah Item',
                data: categoryData,
                backgroundColor: 'rgba(37,99,235,0.85)',
                borderRadius: 12,
                maxBarThickness: 36,
            }]
        },
        options: { ...chartOptions, scales: { ...chartOptions.scales, y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });

    new Chart(document.getElementById('conditionChart'), {
        type: 'doughnut',
        data: {
            labels: conditionLabels,
            datasets: [{
                data: conditionData,
                backgroundColor: ['#2563eb', '#0ea5e9', '#7dd3fc', '#cbd5e1'],
                hoverOffset: 8,
                borderWidth: 0,
            }]
        },
        options: { ...chartOptions, aspectRatio: 1.1, plugins: { ...chartOptions.plugins, legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('acquisitionChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Pengadaan',
                data: monthData,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(59,130,246,0.16)',
                tension: 0.35,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#2563eb',
            }]
        },
        options: { ...chartOptions, scales: { ...chartOptions.scales, y: { beginAtZero: true } }, plugins: { ...chartOptions.plugins, legend: { display: false } } }
    });

    new Chart(document.getElementById('stockChart'), {
        type: 'bar',
        data: {
            labels: stockCategoryLabels,
            datasets: [{
                label: 'Stok',
                data: stockCategoryData,
                backgroundColor: 'rgba(14,165,233,0.85)',
                borderRadius: 12,
                maxBarThickness: 36,
            }]
        },
        options: { ...chartOptions, scales: { ...chartOptions.scales, y: { beginAtZero: true } } }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('inventorySearch');
        const filterSelect = document.getElementById('conditionFilter');
        const rows = Array.from(document.querySelectorAll('#inventoryTable tbody tr'));

        function updateTable() {
            const query = searchInput.value.trim().toLowerCase();
            const filter = filterSelect.value;

            rows.forEach(row => {
                const text = row.dataset.search || '';
                const condition = row.dataset.condition || '';
                const matchesSearch = query === '' || text.includes(query);
                const matchesFilter = filter === 'all' || condition === filter;
                row.style.display = matchesSearch && matchesFilter ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', updateTable);
        filterSelect.addEventListener('change', updateTable);
    });
</script>
@endsection