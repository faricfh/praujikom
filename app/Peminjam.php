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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($peminjam) {
            // mengecek apakah penulis masih punya
            if ($peminjam->kartupendaftaran->count() > 0) {
                //menyiapkan pesan error
                $html = 'Peminjam tidak bisa dihapus karena masih digunakan oleh kartupendaftaran: ';
                $html .= '<ul>';
                foreach ($peminjam->kartupendaftaran as $data) {
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

            if ($peminjam->peminjaman->count() > 0) {
                //menyiapkan pesan error
                $html = 'Peminjam tidak bisa dihapus karena masih digunakan oleh peminjaman: ';
                $html .= '<ul>';
                foreach ($peminjam->peminjaman as $data) {
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
