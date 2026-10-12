<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('petugas_id');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->enum('status', ['dipinjam', 'dikembalikan'])
                  ->default('dipinjam');
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku');
            $table->foreign('anggota_id')->references('id')->on('anggota');
            $table->foreign('petugas_id')->references('id')->on('petugas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}