<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['kode', 'nama'];
    public $timestamps = true;

    public function buku()
    {
        return $this->hasMany('App\Buku','kategori_kode');
    }
}
