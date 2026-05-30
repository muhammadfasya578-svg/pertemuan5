@extends('layouts.app')
@section('title', 'Item Conditions')
@section('breadcrumb', 'Conditions')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Item Conditions</h1>
        <p class="page-subtitle">Manage condition statuses for inventory items</p>
    </div>
    <a href="{{ route('kondisi.create') }}" class="btn btn-primary btn-base">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
        Add Condition
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($kondisis->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No Conditions</div>
                <div class="empty-state-text">Create your first condition status</div>
                <a href="{{ route('kondisi.create') }}" class="btn btn-primary btn-base mt-4">Create Condition</a>
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kondisis as $kondisi)
                            <tr>
                                <td class="font-medium">{{ $kondisi->nama }}</td>
                                <td><code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $kondisi->kode }}</code></td>
                                <td class="text-gray-600">{{ $kondisi->deskripsi ?? '-' }}</td>
                                <td><span class="badge {{ $kondisi->badge_class }}">{{ $kondisi->nama }}</span></td>
                                <td><span class="badge badge-gray">{{ $kondisi->inventaris()->count() }}</span></td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('kondisi.edit', $kondisi) }}" class="btn btn-ghost btn-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('kondisi.destroy', $kondisi) }}" method="POST" style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-sm text-red-600 hover:text-red-700" onclick="return confirm('Delete this condition?')" title="Delete">
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
