<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['kode', 'petugas_kode','peminjam_kode','tgl','tgl_hrs_kembali'];
    public $timestamps = true;

    public function peminjam()
    {
        return $this->belongsTo('App\Peminjam','peminjam_kode');
    }

    public function petugas()
    {
        return $this->belongsTo('App\Petugas','petugas_kode');
    }

    public function detailpinjam()
    {
        return $this->hasOne('App\DetailPinjam','peminjaman_kode');
    }
}
