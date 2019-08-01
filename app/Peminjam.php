<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $fillable = ['kode', 'nama','alamat','telp','foto'];
    public $timestamps = true;

    public function kartupendaftaran()
    {
        return $this->hasOne('App\KartuPendaftaran','peminjam_kode');
    }

    public function peminjaman()
    {
        return $this->hasOne('App\Peminjaman','peminjam_kode');
    }
}
