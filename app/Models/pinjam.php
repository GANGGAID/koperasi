<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'jumlah',
        'sisa_pinjaman',
        'bunga',
        'tenor',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'status'
    ];

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
