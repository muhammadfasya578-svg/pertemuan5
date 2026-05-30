@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Welcome to LabInvent</h1>
        <p class="page-subtitle">Laboratory Inventory Management System</p>
    </div>
</div>

<!-- Quick Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Items</div>
        <div class="stat-value">{{ \App\Models\Inventaris::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Categories</div>
        <div class="stat-value">{{ \App\Models\Kategori::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Conditions</div>
        <div class="stat-value">{{ \App\Models\Kondisi::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Good Condition</div>
        <div class="stat-value">{{ \App\Models\Inventaris::whereHas('kondisi', fn($q) => $q->where('nama', 'Baik'))->count() }}</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mb-6">
    <div class="card-header">
        <div class="card-title">Quick Actions</div>
    </div>
    <div class="card-body">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('inventaris.create') }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <div>
                    <p class="font-semibold text-gray-900">Add Inventory Item</p>
                    <p class="text-sm text-gray-600">Create a new item</p>
                </div>
            </a>
            <a href="{{ route('kategori.create') }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                <div>
                    <p class="font-semibold text-gray-900">Add Category</p>
                    <p class="text-sm text-gray-600">Create a new category</p>
                </div>
            </a>
            <a href="{{ route('inventaris.index') }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <div>
                    <p class="font-semibold text-gray-900">View Inventory</p>
                    <p class="text-sm text-gray-600">Browse all items</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Recent Items -->
<div class="card">
    <div class="card-header">
        <div class="card-title">Recent Items</div>
        <a href="{{ route('inventaris.index') }}" class="text-sm link">View all →</a>
    </div>
    <div class="card-body">
        @php
            $recent = \App\Models\Inventaris::latest()->limit(5)->get();
        @endphp
        
        @if ($recent->isEmpty())
            <div class="empty-state py-8">
                <div class="empty-state-title">No items yet</div>
                <div class="empty-state-text">Start by adding your first inventory item</div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Condition</th>
                            <th>Qty</th>
                            <th>Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent as $item)
                            <tr>
                                <td><code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $item->kode }}</code></td>
                                <td class="font-medium">{{ $item->nama }}</td>
                                <td><span class="badge badge-blue">{{ $item->kategori->nama }}</span></td>
                                <td><span class="badge {{ $item->kondisi->badge_class ?? 'badge-gray' }}">{{ $item->kondisi->nama ?? 'N/A' }}</span></td>
                                <td>{{ $item->jumlah }}</td>
                                <td class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
