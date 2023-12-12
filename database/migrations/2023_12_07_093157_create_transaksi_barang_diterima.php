<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiBarangDiterima extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('transaksi_barang_diterima', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->nullable(false);
            $table->string('jenis_surat', 10)->nullable(false);
            $table->string('nama_barang', 120)->nullable(false);
            $table->integer('qty');
            $table->string('satuan', 50)->nullable(false);
            $table->integer('harga_satuan')->nullable(false);
            $table->integer('jumlah')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('transaksi_barang_diterima');
    }
}