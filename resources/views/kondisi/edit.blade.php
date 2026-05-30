@extends('layouts.app')
@section('title', 'Edit Condition')
@section('breadcrumb', 'Edit Condition')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Condition</h1>
        <p class="page-subtitle">Update condition information</p>
    </div>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <div class="card-title">Condition Information</div>
    </div>
    <div class="card-body">
        <form action="{{ route('kondisi.update', $kondisi) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Name <span class="required">*</span></label>
                <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'has-error' : '' }}"
                       value="{{ old('nama', $kondisi->nama) }}" placeholder="e.g., Good Condition">
                @error('nama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Code <span class="required">*</span></label>
                <input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'has-error' : '' }}"
                       value="{{ old('kode', $kondisi->kode) }}" placeholder="e.g., GOOD">
                @error('kode') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Badge Color</label>
                <select name="badge_color" class="form-control">
                    <option value="green" @selected(old('badge_color', $kondisi->badge_color) == 'green')>Good (Green)</option>
                    <option value="yellow" @selected(old('badge_color', $kondisi->badge_color) == 'yellow')>Warning (Amber)</option>
                    <option value="red" @selected(old('badge_color', $kondisi->badge_color) == 'red')>Danger (Red)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="deskripsi" class="form-control" rows="4" 
                          placeholder="Enter condition description...">{{ old('deskripsi', $kondisi->deskripsi) }}</textarea>
                @error('deskripsi') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-primary btn-base">Update Condition</button>
                <a href="{{ route('kondisi.index') }}" class="btn btn-secondary btn-base">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
