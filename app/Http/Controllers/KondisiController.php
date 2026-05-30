<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Kondisi::withCount('inventaris')->orderBy('nama');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('nama', 'like', "%{$q}%");
        }

        $kondisis = $query->paginate(10)->withQueryString();

        return view('kondisi.index', compact('kondisis'));
    }

    public function create()
    {
        return view('kondisi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kondisis,kode',
            'nama' => 'required|min:3|max:50|unique:kondisis,nama',
            'badge_color' => 'required|in:green,yellow,red,gray',
            'deskripsi' => 'nullable|max:1000',
        ], [
            'kode.required' => 'Kode kondisi harus diisi.',
            'kode.unique' => 'Kode kondisi sudah terdaftar.',
            'nama.required' => 'Nama kondisi harus diisi.',
            'nama.unique' => 'Nama kondisi sudah terdaftar.',
            'badge_color.required' => 'Warna badge harus dipilih.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        Kondisi::create($validated);

        return redirect()
            ->route('kondisi.index')
            ->with('success', 'Kondisi berhasil ditambahkan.');
    }

    public function edit(Kondisi $kondisi)
    {
        return view('kondisi.edit', compact('kondisi'));
    }

    public function update(Request $request, Kondisi $kondisi)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kondisis,kode,' . $kondisi->id,
            'nama' => 'required|min:3|max:50|unique:kondisis,nama,' . $kondisi->id,
            'badge_color' => 'required|in:green,yellow,red,gray',
            'deskripsi' => 'nullable|max:1000',
        ], [
            'kode.required' => 'Kode kondisi harus diisi.',
            'kode.unique' => 'Kode kondisi sudah terdaftar.',
            'nama.required' => 'Nama kondisi harus diisi.',
            'nama.unique' => 'Nama kondisi sudah terdaftar.',
            'badge_color.required' => 'Warna badge harus dipilih.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        $kondisi->update($validated);

        return redirect()
            ->route('kondisi.index')
            ->with('success', 'Kondisi berhasil diperbarui.');
    }

    public function destroy(Kondisi $kondisi)
    {
        if ($kondisi->inventaris()->count() > 0) {
            return redirect()
                ->route('kondisi.index')
                ->with('error', 'Tidak dapat menghapus kondisi karena masih digunakan oleh ' . $kondisi->inventaris()->count() . ' barang inventaris.');
        }

        $kondisi->delete();

        return redirect()
            ->route('kondisi.index')
            ->with('success', 'Kondisi berhasil dihapus.');
    }
}
