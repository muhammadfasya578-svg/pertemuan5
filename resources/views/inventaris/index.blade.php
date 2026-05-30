@extends('layouts.app')
@section('title', 'Inventory Items')
@section('breadcrumb', 'Inventory')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Inventory Items</h1>
            <p class="page-subtitle">Manage all laboratory equipment and supplies</p>
        </div>
        <a href="{{ route('inventaris.create') }}" class="btn btn-primary btn-base">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Add Item
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Good Condition</div>
            <div class="stat-value">{{ $stats['baik'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Minor Damage</div>
            <div class="stat-value">{{ $stats['ringan'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Severe Damage</div>
            <div class="stat-value">{{ $stats['berat'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Items</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-6">
        <div class="card-body">
            <form method="GET" action="{{ route('inventaris.index') }}" class="form-grid grid-3">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input type="text" name="q" class="form-control" value="{{ request('q') }}"
                        placeholder="Code, name, or location...">
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="kategori_id" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" @selected(request('kategori_id') == $kategori->id)>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Condition</label>
                    <select name="kondisi_id" class="form-control">
                        <option value="">All Conditions</option>
                        @foreach ($kondisis as $kondisi)
                            <option value="{{ $kondisi->id }}" @selected(request('kondisi_id') == $kondisi->id)>
                                {{ $kondisi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 col-span-3">
                    <button type="submit" class="btn btn-primary btn-base">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                    @if (request('q') || request('kategori_id') || request('kondisi_id'))
                        <a href="{{ route('inventaris.index') }}" class="btn btn-secondary btn-base">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        @if ($inventaris->isEmpty())
            <div class="card-body">
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <div class="empty-state-title">No Items Found</div>
                    <div class="empty-state-text">Start by adding your first inventory item</div>
                    <a href="{{ route('inventaris.create') }}" class="btn btn-primary btn-base mt-4">Add First Item</a>
                </div>
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Qty</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventaris as $item)
                            <tr>
                                <td><code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $item->kode_barang }}</code></td>
                                <td class="font-medium">{{ $item->nama_barang }}</td>
                                <td><span class="badge badge-blue">{{ $item->kategori->nama }}</span></td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                    @if (is_object($item->kondisi) && $item->kondisi)
                                        <span class="badge badge-{{ $item->kondisi->badge_color }}">{{ $item->kondisi->nama }}</span>
                                    @elseif (is_string($item->kondisi) && $item->kondisi)
                                        <span class="badge badge-yellow">{{ $item->kondisi }}</span>
                                    @else
                                        <span class="badge badge-gray">—</span>
                                    @endif
                                </td>
                                <td class="text-right">{{ $item->jumlah }}</td>
                                <td class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('inventaris.show', $item) }}" class="btn btn-ghost btn-sm" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('inventaris.edit', $item) }}" class="btn btn-ghost btn-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('inventaris.destroy', $item) }}" method="POST"
                                            style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-sm text-red-600 hover:text-red-700"
                                                onclick="return confirm('Delete this item?')" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <p class="text-sm text-gray-600">Showing {{ $inventaris->count() }} of {{ $inventaris->total() }} items</p>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    {{ $inventaris->links() }}

@endsection