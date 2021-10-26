<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';
    protected $fillable = [
        'kategori_id', 'nama', 'deskripsi'
    ];

    public function kategori() 
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function bahan()
    {
        return $this->belongsToMany(Bahan::class, 'bahan_resep', 'resep_id', 'bahan_id');
    }
}
