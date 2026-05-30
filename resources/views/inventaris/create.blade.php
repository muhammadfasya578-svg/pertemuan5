@extends('layouts.app')
@section('title', 'Add New Item')
@section('breadcrumb', 'Add Item')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Add New Inventory Item</h1>
        <p class="page-subtitle">Create a new item in your inventory</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Item Details</div>
    </div>
    <div class="card-body">
        <form action="{{ route('inventaris.store') }}" method="POST">
            @csrf
            @include('inventaris._form')
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-primary btn-base">Save Item</button>
                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary btn-base">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
