@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Selamat datang di Sistem Inventaris Laboratorium</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="grid grid-flow-col grid-rows-3 gap-4">
            <div class="row-span-3">
                <div class="stat-card">
                    <div class="stat-card-value">{{ $totalInventaris }}</div>
                    <div class="stat-card-label">Total Inventaris</div>
                </div>
            </div>
            <div class="row-span-3">
                <div class="stat-card">
                    <div class="stat-card-value">{{ $totalKategori }}</div>
                    <div class="stat-card-label">Total Kategori</div>
                </div>
            </div>
            <div class="row-span-3">
                <div class="stat-card">
                    <div class="stat-card-value">{{ $totalKondisi }}</div>
                    <div class="stat-card-label">Jenis Kondisi</div>
                </div>
            </div>
        </div>


    </div>

    <div class="card mt-3">
        <div class="card-header">
            Statistik Kondisi Barang
        </div>

        <div class="card-body">
            @if ($kondisiStats->isEmpty())
                <p class="text-center text-gray-500 py-5">
                    Belum ada data kondisi.
                </p>
            @else

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    @foreach ($kondisiStats as $kondisi)

                        <div class="stat-card
                                                            @if($kondisi->badge_color == 'green')
                                                                green
                                                            @elseif($kondisi->badge_color == 'yellow')
                                                                yellow
                                                            @elseif($kondisi->badge_color == 'red')
                                                                red
                                                            @endif">

                            <div class="stat-card-value">
                                {{ $kondisi->inventaris_count }}
                            </div>

                            <div class="stat-card-label">
                                {{ $kondisi->nama }}
                            </div>

                        </div>

                    @endforeach

                </div>

            @endif
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header"> 5 Barang Terbaru Ditambahkan</div>
        <div class="card-body">
            @if ($barangTerbaru->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <div class="empty-state-title">Belum Ada Data</div>
                    <div class="empty-state-text">Belum ada barang yang ditambahkan ke inventaris.</div>
                    <a href="{{ route('inventaris.create') }}" class="btn btn-primary">Tambah Barang Pertama</a>
                </div>
            @else
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Kondisi</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangTerbaru as $item)
                                <tr>
                                    <td><strong>{{ $item->kode_barang }}</strong></td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td><span class="badge badge-blue">{{ $item->kategori->nama }}</span></td>
                                    <td>
                                        @if (is_object($item->kondisi) && $item->kondisi)
                                            <span
                                                class="badge badge-{{ $item->kondisi->badge_color }}">{{ $item->kondisi->nama }}</span>
                                        @elseif (is_string($item->kondisi) && $item->kondisi)
                                            <span class="badge badge-yellow">{{ $item->kondisi }}</span>
                                        @else
                                            <span class="badge badge-gray">—</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('inventaris.show', $item) }}" class="btn btn-secondary btn-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div style="margin-top: 30px; padding: 20px; background: white; border-radius: 8px; text-align: center; color: #666;">
        <p>Praktikum Pemrograman Web 2 - Politeknik Takumi</p>
    </div>
@endsection