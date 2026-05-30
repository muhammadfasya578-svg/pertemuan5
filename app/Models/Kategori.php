<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'deskripsi'];

    /**
     * Satu kategori memiliki banyak inventaris (hasMany).
     */
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }
}