<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['kode', 'kategori_kode','penerbit_kode','judul','jumlah','deskripsi','pengarang','thn_terbit'];
    public $timestamps = true;

    public function detailpinjam()
    {
        return $this->hasMany('App\DetailPinjam','buku_kode');
    }

    public function penerbit()
    {
        return $this->belongsTo('App\Penerbit','penerbit_kode');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori','kategori_kode');
    }
}
