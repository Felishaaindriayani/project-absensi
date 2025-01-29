<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    protected $fillable = ['id', 'id_user', 'tanggal', 'jam_masuk','jam_keluar','jam_kerja'];
    public $timestamps = true;

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
