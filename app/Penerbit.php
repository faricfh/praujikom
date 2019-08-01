<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $fillable = ['kode', 'nama','alamat','telp'];
    public $timestamps = true;

    public function buku()
    {
        return $this->hasOne('App\Buku','penerbit_kode');
    }
}
