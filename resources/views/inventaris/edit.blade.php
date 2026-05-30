@extends('layouts.app')
@section('title', 'Edit Item')
@section('breadcrumb', 'Edit Item')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Inventory Item</h1>
        <p class="page-subtitle">Update item information</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Item Details</div>
    </div>
    <div class="card-body">
        <form action="{{ route('inventaris.update', $item) }}" method="POST">
            @csrf @method('PUT')
            @include('inventaris._form')
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-primary btn-base">Update Item</button>
                <a href="{{ route('inventaris.show', $item) }}" class="btn btn-secondary btn-base">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
