<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pinjam_id',
        'jumlah_bayar',
        'tanggal_bayar',
    ];

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class);
    }
}
