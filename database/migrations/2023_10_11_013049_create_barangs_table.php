<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string("kode_barang");
            $table->string("nama_barang");
            $table->enum('satuan_barang', ['satuan', 'kelompok']);
            $table->enum('status_barang', ['ada', 'dipinjam']);
            $table->integer("jumlah_satuan");
            $table->foreignId('tipe_barang_id')->constrained();
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
        Schema::dropIfExists('barangs');
    }
};
