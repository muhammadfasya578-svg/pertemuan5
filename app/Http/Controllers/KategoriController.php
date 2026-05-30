<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('inventaris')->orderBy('nama');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($data) use ($q) {
                $data->where('kode', 'like', "%{$q}%")
                     ->orWhere('nama', 'like', "%{$q}%");
            });
        }

        $kategoris = $query->paginate(10)->withQueryString();

        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kategoris,kode',
            'nama' => 'required|min:3|max:100|unique:kategoris,nama',
            'deskripsi' => 'nullable|max:1000',
        ], [
            'kode.required' => 'Kode kategori harus diisi.',
            'kode.unique' => 'Kode kategori sudah terdaftar.',
            'nama.required' => 'Nama kategori harus diisi.',
            'nama.unique' => 'Nama kategori sudah terdaftar.',
            'deskripsi.max' => 'Deskripsi kategori maksimal 1000 karakter.',
        ]);

        Kategori::create($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kategoris,kode,' . $kategori->id,
            'nama' => 'required|min:3|max:100|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|max:1000',
        ], [
            'kode.required' => 'Kode kategori harus diisi.',
            'kode.unique' => 'Kode kategori sudah terdaftar.',
            'nama.required' => 'Nama kategori harus diisi.',
            'nama.unique' => 'Nama kategori sudah terdaftar.',
            'deskripsi.max' => 'Deskripsi kategori maksimal 1000 karakter.',
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->inventaris()->count() > 0) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Tidak dapat menghapus kategori karena masih memiliki ' . $kategori->inventaris()->count() . ' barang inventaris.');
        }

        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
