@extends('layouts.app')
@section('title', 'Categories')
@section('breadcrumb', 'Categories')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Categories</h1>
        <p class="page-subtitle">Manage inventory item categories</p>
    </div>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-base">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
        Add Category
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($kategoris->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No Categories</div>
                <div class="empty-state-text">Create your first category to organize inventory items</div>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-base mt-4">Create Category</a>
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Items</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $kategori)
                            <tr>
                                <td class="font-medium">{{ $kategori->nama }}</td>
                                <td class="text-gray-600">{{ $kategori->deskripsi ?? '-' }}</td>
                                <td><span class="badge badge-gray">{{ $kategori->inventaris()->count() }}</span></td>
                                <td class="text-xs text-gray-500">{{ $kategori->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-ghost btn-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-sm text-red-600 hover:text-red-700" onclick="return confirm('Delete this category?')" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
