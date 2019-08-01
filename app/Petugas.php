<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $fillable = ['kode', 'nama'];
    public $timestamps = true;

    public function kartupendaftaran()
    {
        return $this->hasOne('App\kartuPendaftaran','petugas_kode');
    }

    public function peminjaman()
    {
        return $this->hasOne('App\Peminjaman','petugas_kode');
    }
}
