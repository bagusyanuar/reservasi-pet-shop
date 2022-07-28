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
        'sub_total',
        'transport',
        'diskon',
        'total',
        'status',
    ];
}
