<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $fillable = ['id', 'jabatan'];
    public $timestamps = true;

    public function pegawai()
    {
        return $this->hasMany(User::class, 'id_jabatan');
    }
}
