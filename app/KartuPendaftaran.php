<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuPendaftaran extends Model
{
    protected $fillable = ['kartu_barkode', 'petugas_kode','peminjam_kode','tgl_pembuatan','tgl_akhir','status_aktif'];
    public $timestamps = true;

    public function peminjam()
    {
        return $this->belongsTo('App\Peminjam','peminjam_kode');
    }

    public function petugas()
    {
        return $this->belongsTo('App\Petugas','petugas_kode');
    }

}
