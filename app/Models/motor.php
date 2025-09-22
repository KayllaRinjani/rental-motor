<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'status', // pastikan ditambah kalau kamu pakai kolom status
    ];

    // relasi ke pemilik (jika ada)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // relasi ke tarif rental (jika ada tabel terpisah)
    public function rentalRate()
    {
        return $this->hasOne(RentalRate::class);
    }
}
