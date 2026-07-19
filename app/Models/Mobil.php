<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'merek', 'tipe', 'nomor_polisi', 'harga_sewa_per_hari', 'status', 'foto'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}