<?php

namespace Database\Seeders;

use App\Models\Kondisi;
use Illuminate\Database\Seeder;

class KondisiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode'        => 'BAIK',
                'nama'        => 'Baik',
                'badge_color' => 'green',
                'deskripsi'   => 'Barang dalam kondisi baik dan siap digunakan.',
            ],
            [
                'kode'        => 'RUSAK-R',
                'nama'        => 'Rusak Ringan',
                'badge_color' => 'yellow',
                'deskripsi'   => 'Barang mengalami kerusakan ringan, masih dapat digunakan dengan keterbatasan.',
            ],
            [
                'kode'        => 'RUSAK-B',
                'nama'        => 'Rusak Berat',
                'badge_color' => 'red',
                'deskripsi'   => 'Barang mengalami kerusakan berat dan tidak dapat digunakan.',
            ],
        ];

        foreach ($data as $item) {
            Kondisi::updateOrCreate(['kode' => $item['kode']], $item);
        }
    }
}