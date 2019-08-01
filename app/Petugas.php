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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($petugas) {
            // mengecek apakah penulis masih punya
            if ($petugas->kartupendaftaran->count() > 0) {
                //menyiapkan pesan error
                $html = 'Petugas tidak bisa dihapus karena masih digunakan oleh kartupendaftaran: ';
                $html .= '<ul>';
                foreach ($petugas->kartupendaftaran as $data) {
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

            if ($petugas->peminjaman->count() > 0) {
                //menyiapkan pesan error
                $html = 'Petugas tidak bisa dihapus karena masih digunakan oleh peminjaman: ';
                $html .= '<ul>';
                foreach ($petugas->peminjaman as $data) {
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
