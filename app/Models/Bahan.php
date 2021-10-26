<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahan';
    protected $fillable = [
        'bahan', 'jumlah'
    ];

    public function resep()
    {
        return $this->belongsToMany(Resep::class, 'bahan_resep', 'bahan_id');
    }
}
