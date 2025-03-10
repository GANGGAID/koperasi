<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class simpan extends Model
{
    use HasFactory;
    protected $table = 'simpans';

    protected $fillable = [
        'anggota_id',
        'jumlah',
        'jenis',
        'tanggal',
    ];

    protected $dates = [
        'tanggal',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id');
    }
}
