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
        $totalStock = Inventaris::sum('jumlah');

        $kondisiStats = Kondisi::withCount('inventaris')->orderBy('nama')->get();
        $categoryStats = Kategori::withCount('inventaris')->orderBy('nama')->get();
        $stockByCategory = Kategori::withSum('inventaris', 'jumlah')->orderBy('nama')->get();
        $monthlyAcquisitions = Inventaris::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($row) {
                return [
                    'month' => \DateTime::createFromFormat('!m', $row->month)->format('M'),
                    'year' => $row->year,
                    'count' => $row->count,
                ];
            });

        $barangTerbaru = Inventaris::with('kategori', 'kondisi')
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalInventaris',
            'totalKategori',
            'totalKondisi',
            'totalStock',
            'kondisiStats',
            'categoryStats',
            'stockByCategory',
            'monthlyAcquisitions',
            'barangTerbaru'
        ));
    }
}
