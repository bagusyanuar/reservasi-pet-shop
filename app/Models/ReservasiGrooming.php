<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiGrooming extends Model
{
    use HasFactory;

    protected $table = 'reservasi_grooming';

    protected $fillable = [
        'tanggal',
        'jam',
        'reservasi_id',
        'kucing_id',
        'transport',
        'alamat',
        'catatan',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id');
    }

    public function kucing()
    {
        return $this->belongsTo(Kucing::class, 'kucing_id');
    }
}
