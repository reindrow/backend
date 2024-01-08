<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelianitems', function (Blueprint $table) {
            $table->id('id_pembelianitem');
            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produks');  
            $table->unsignedBigInteger('id_pembelian');
            $table->foreign('id_pembelian')->references('id_pembelian')->on('pembelians');  
            $table->integer('kuantitas');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelianitems');

    }
};
