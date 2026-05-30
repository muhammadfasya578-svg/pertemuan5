<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInventaris = Inventaris::count();
        $totalKategori = Kategori::count();
        $totalKondisi = Kondisi::count();

        // Statistik kondisi
        $kondisiStats = Kondisi::withCount('inventaris')->get();

        // 5 barang terbaru (dengan kondisi yang valid)
        $barangTerbaru = Inventaris::with('kategori', 'kondisi')
            ->whereNotNull('kondisi_id')
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalInventaris',
            'totalKategori',
            'totalKondisi',
            'kondisiStats',
            'barangTerbaru'
        ));
    }
}
