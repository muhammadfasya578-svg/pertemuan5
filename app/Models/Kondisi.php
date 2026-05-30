<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'badge_color', 'deskripsi'];

    /**
     * Satu kondisi dimiliki banyak inventaris.
     */
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }

    /**
     * Kembalikan class badge CSS berdasarkan warna kondisi.
     */
    public function badgeClass(): string
    {
        return match ($this->badge_color) {
            'green' => 'badge-baik',
            'yellow' => 'badge-rusak-ringan',
            'red'   => 'badge-rusak-berat',
            default => 'badge-gray',
        };
    }
}