<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

protected $fillable = [
    'kategori_id',
    'kondisi_id',
    'kode_barang',
    'nama_barang',
    'merek',
    'lokasi',
    'jumlah',
    'tanggal_pengadaan',
    'keterangan',
];

    protected $casts = [
        'tanggal_pengadaan' => 'date',
    ];

    /**
     * Setiap barang inventaris dimiliki oleh satu kategori (belongsTo).
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Setiap barang inventaris memiliki satu kondisi (belongsTo).
     */
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }
}