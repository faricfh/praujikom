<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['kode', 'nama'];
    public $timestamps = true;

    public function buku()
    {
        return $this->hasOne('App\Buku','kategori_kode');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategori) {
            // mengecek apakah penulis masih punya
            if ($kategori->buku->count() > 0) {
                //menyiapkan pesan error
                $html = 'kategori tidak bisa dihapus karena masih digunakan oleh buku: ';
                $html .= '<ul>';
                foreach ($kategori->buku as $data) {
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
