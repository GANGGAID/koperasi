<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    use HasFactory;
    protected $table = 'anggotas';

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
        'jenis_kelamin',
        'nama_pewaris',
        'tanggal_masuk',
        'tanggal_keluar'
    ];

    protected $dates = [
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function simpan()
{
    return $this->hasMany(Simpan::class);
}

public function simpans()
    {
        return $this->hasMany(Simpan::class, 'anggota_id', 'id');
    }

}
