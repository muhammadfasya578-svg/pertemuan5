<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::with(['kategori', 'kondisi'])->latest();

        // Pencarian: kode, nama barang, lokasi
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($data) use ($q) {
                $data->where('kode_barang', 'like', "%{$q}%")
                    ->orWhere('nama_barang', 'like', "%{$q}%")
                    ->orWhere('lokasi', 'like', "%{$q}%")
                    ->orWhere('merek', 'like', "%{$q}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter kondisi
        if ($request->filled('kondisi_id')) {
            $query->where('kondisi_id', $request->kondisi_id);
        }

        $inventaris = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();

        // Statistik ringkasan kondisi untuk ditampilkan di halaman index
        $statTotal = Inventaris::count();
        $statPerKondisi = Kondisi::withCount('inventaris')->get();

        $stats = [
            'baik' => $statPerKondisi->firstWhere('kode', 'BAIK')->inventaris_count ?? 0,
            'ringan' => $statPerKondisi->firstWhere('kode', 'RUSAK-R')->inventaris_count ?? 0,
            'berat' => $statPerKondisi->firstWhere('kode', 'RUSAK-B')->inventaris_count ?? 0,
            'total' => $statTotal,
        ];

        return view('inventaris.index', compact(
            'inventaris',
            'kategoris',
            'kondisis',
            'statTotal',
            'statPerKondisi',
            'stats'
        ));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();
        return view('inventaris.create', compact('kategoris', 'kondisis') + ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi_id' => 'required|exists:kondisis,id',
            'kode_barang' => 'required|max:30|unique:inventaris,kode_barang',
            'nama_barang' => 'required|min:3|max:150',
            'merek' => 'nullable|max:100',
            'lokasi' => 'required|max:100',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date|before_or_equal:today',
            'keterangan' => 'nullable|max:1000',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',

            'kondisi_id.required' => 'Kondisi wajib dipilih.',
            'kondisi_id.exists' => 'Kondisi tidak valid.',

            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'kode_barang.max' => 'Kode barang maksimal 30 karakter.',

            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 150 karakter.',

            'merek.max' => 'Merek maksimal 100 karakter.',

            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 100 karakter.',

            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',

            'tanggal_pengadaan.date' => 'Format tanggal tidak valid.',
            'tanggal_pengadaan.before_or_equal'
            => 'Tanggal pengadaan tidak boleh melebihi hari ini.',

            'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        Inventaris::create($validated);

        return redirect()
            ->route('inventaris.index')
            ->with(
                'success',
                'Data inventaris <strong>' .
                e($validated['nama_barang']) .
                '</strong> berhasil ditambahkan.'
            );
    }

    public function show(Inventaris $inventari)
    {
        $inventari->load(['kategori', 'kondisi']);
        return view('inventaris.show', ['item' => $inventari]);
    }

    public function edit(Inventaris $inventari)
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();
        return view('inventaris.edit', [
            'item' => $inventari,
            'kategoris' => $kategoris,
            'kondisis' => $kondisis,
        ]);
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi_id' => 'required|exists:kondisis,id',
            'kode_barang' => 'required|max:30|unique:inventaris,kode_barang,' . $inventari->id,
            'nama_barang' => 'required|min:3|max:150',
            'merek' => 'nullable|max:100',
            'lokasi' => 'required|max:100',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date|before_or_equal:today',
            'keterangan' => 'nullable|max:1000',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'kondisi_id.required' => 'Kondisi wajib dipilih.',
            'kondisi_id.exists' => 'Kondisi tidak valid.',
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan, gunakan kode lain.',
            'kode_barang.max' => 'Kode barang maksimal 30 karakter.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 150 karakter.',
            'merek.max' => 'Merek maksimal 100 karakter.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 100 karakter.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'tanggal_pengadaan.date' => 'Format tanggal tidak valid.',
            'tanggal_pengadaan.before_or_equal' => 'Tanggal pengadaan tidak boleh melebihi hari ini.',
            'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        $inventari->update($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris <strong>' . e($inventari->nama_barang) . '</strong> berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $nama = $inventari->nama_barang;
        $inventari->delete();

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris <strong>' . e($nama) . '</strong> berhasil dihapus.');
    }
}