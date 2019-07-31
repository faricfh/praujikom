<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode');
            $table->unsignedBigInteger('kategori_kode');
            $table->foreign('kategori_kode')->references('id')->on('kategoris')->onDelete('cascade');

            $table->unsignedBigInteger('penerbit_kode');
            $table->foreign('penerbit_kode')->references('id')->on('penerbits')->onDelete('cascade');

            $table->string('judul');
            $table->integer('jumlah');
            $table->string('deskripsi');
            $table->string('pengarang');
            $table->integer('thn_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
