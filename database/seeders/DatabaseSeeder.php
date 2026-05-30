<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting: kondisi & kategori harus ada sebelum inventaris
        $this->call([
            KondisiSeeder::class,
            KategoriSeeder::class,
        ]);
    }
}