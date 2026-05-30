@extends('layouts.app')
@section('title', $item->nama)
@section('breadcrumb', $item->nama)

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">{{ $item->nama }}</h1>
        <p class="page-subtitle">Item code: <code class="text-sm">{{ $item->kode }}</code></p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('inventaris.edit', $item) }}" class="btn btn-primary btn-base">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Edit
        </a>
        <form action="{{ route('inventaris.destroy', $item) }}" method="POST" style="display: inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-base" onclick="return confirm('Delete this item?')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Delete
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <div class="md:col-span-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Item Information</div>
            </div>
            <div class="card-body">
                <dl class="space-y-6">
                    <div>
                        <dt class="text-sm font-semibold text-gray-600">Category</dt>
                        <dd class="mt-2"><span class="badge badge-blue">{{ $item->kategori->nama }}</span></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-gray-600">Condition</dt>
                        <dd class="mt-2"><span class="badge {{ $item->kondisi->badge_class }}">{{ $item->kondisi->nama }}</span></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-gray-600">Brand</dt>
                        <dd class="mt-2 text-gray-900">{{ $item->merek ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-gray-600">Location</dt>
                        <dd class="mt-2 text-gray-900">{{ $item->lokasi }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-gray-600">Quantity</dt>
                        <dd class="mt-2 text-2xl font-bold text-gray-900">{{ $item->jumlah }}</dd>
                    </div>
                    @if ($item->deskripsi)
                        <div>
                            <dt class="text-sm font-semibold text-gray-600">Description</dt>
                            <dd class="mt-2 text-gray-900 whitespace-pre-wrap">{{ $item->deskripsi }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Dates</div>
            </div>
            <div class="card-body space-y-4">
                @if ($item->tanggal_pengadaan)
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase">Acquisition Date</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $item->tanggal_pengadaan->format('d F Y') }}</p>
                    </div>
                @endif
                <div>
                    <p class="text-xs font-semibold text-gray-600 uppercase">Created</p>
                    <p class="mt-1 text-sm text-gray-900">{{ $item->created_at->format('d F Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-600 uppercase">Last Updated</p>
                    <p class="mt-1 text-sm text-gray-900">{{ $item->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('inventaris.index') }}" class="link">← Back to Inventory</a>
</div>

@endsection
