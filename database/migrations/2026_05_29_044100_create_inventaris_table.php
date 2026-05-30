<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('kode_barang', 30)->unique();
            $table->string('nama_barang', 150);
            $table->string('merek', 100)->nullable();
$table->string('lokasi', 100);
$table->foreignId('kondisi_id')->constrained('kondisis')->cascadeOnUpdate()->restrictOnDelete();
$table->unsignedInteger('jumlah')->default(1);
            $table->date('tanggal_pengadaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};