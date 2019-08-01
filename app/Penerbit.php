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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($penerbit) {
            // mengecek apakah penulis masih punya
            if ($penerbit->buku->count() > 0) {
                //menyiapkan pesan error
                $html = 'penerbit tidak bisa dihapus karena masih digunakan oleh buku: ';
                $html .= '<ul>';
                foreach ($penerbit->buku as $data) {
                    $html .= "<li>$data->judul<li>";
                }
                $html .= '<ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html
                ]);
                //membatalkan proses penghapusan
                return false;
            }
        });
    }
}
