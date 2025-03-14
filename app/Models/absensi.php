<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class absensi extends Model
{
    protected $fillable = ['id', 'id_user', 'tanggal', 'jam_masuk','jam_keluar','jam_kerja'];
    public $timestamps = true;

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
