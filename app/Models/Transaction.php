<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'no_transaksi',
        'sub_total',
        'ongkir',
        'total',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'transaction_id');
    }

    public function waiting_payment()
    {
        return $this->hasOne(Payment::class, 'transaction_id')
            ->orderBy('id', 'DESC');
    }
}
