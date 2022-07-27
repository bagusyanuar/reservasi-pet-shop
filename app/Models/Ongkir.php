<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;

    protected $table = 'ongkir';

    protected $fillable = [
        'kota_id',
        'total',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }
}
