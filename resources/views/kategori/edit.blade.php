@extends('layouts.app')
@section('title', 'Edit Category')
@section('breadcrumb', 'Edit Category')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Category</h1>
        <p class="page-subtitle">Update category information</p>
    </div>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <div class="card-title">Category Information</div>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Code <span class="required">*</span></label>
                <input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'has-error' : '' }}"
                       value="{{ old('kode', $kategori->kode) }}" placeholder="e.g., ELEC">
                @error('kode') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Name <span class="required">*</span></label>
                <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'has-error' : '' }}"
                       value="{{ old('nama', $kategori->nama) }}" placeholder="e.g., Electronics">
                @error('nama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="deskripsi" class="form-control" rows="4" 
                          placeholder="Enter category description...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-primary btn-base">Update Category</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary btn-base">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
