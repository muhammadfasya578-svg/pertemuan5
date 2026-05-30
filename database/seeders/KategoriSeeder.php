<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'LPT', 'nama' => 'Laptop',             'deskripsi' => 'Perangkat komputer portabel.'],
            ['kode' => 'PRJ', 'nama' => 'Proyektor',          'deskripsi' => 'Alat presentasi visual.'],
            ['kode' => 'JRG', 'nama' => 'Perangkat Jaringan', 'deskripsi' => 'Router, switch, dan perangkat jaringan lainnya.'],
            ['kode' => 'AKS', 'nama' => 'Aksesoris Lab',      'deskripsi' => 'Mouse, keyboard, kabel, dan aksesoris pendukung.'],
        ];

        foreach ($data as $item) {
            Kategori::updateOrCreate(['kode' => $item['kode']], $item);
        }
    }
}