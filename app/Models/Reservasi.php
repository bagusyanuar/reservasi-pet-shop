<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'no_transaksi',
        'paket_id',
        'tipe',
        'sub_total',
        'transport',
        'diskon',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function grooming()
    {
        return $this->hasOne(ReservasiGrooming::class, 'reservasi_id');
    }

    public function penitipan()
    {
        return $this->hasOne(ReservasiPenitipan::class, 'reservasi_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'reservasi_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
