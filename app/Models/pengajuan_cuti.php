<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengajuan_cuti extends Model
{
    protected $fillable = ['id', 'id_user', 'tanggal_pengajuan', 'kategori_cuti','tanggal_mulai','tanggal_selesai','alasan','status'];
    public $timestamps = true;

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
