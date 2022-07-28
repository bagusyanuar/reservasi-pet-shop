<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiPenitipan extends Model
{
    use HasFactory;

    protected $table = 'reservasi_penitipan';

    protected $fillable = [
        'reservasi_id',
        'kucing_id',
        'transport',
        'check_in',
        'check_out',
        'alamat',
        'catatan',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id');
    }
}
