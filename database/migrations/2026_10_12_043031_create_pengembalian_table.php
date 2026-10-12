<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianTable extends Migration
{
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('peminjaman_id');
            $table->date('tanggal_pengembalian');
            $table->integer('denda')->default(0);
            $table->enum('kondisi_buku', ['baik', 'rusak', 'hilang'])
                  ->default('baik');
            $table->timestamps();

            $table->foreign('peminjaman_id')
                  ->references('id')
                  ->on('peminjaman');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
}