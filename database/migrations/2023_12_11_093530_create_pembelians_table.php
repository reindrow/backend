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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id('id_pembelian');
            $table->date('tanggal_pembelian');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_server');
            $table->foreign('id_user')->references('id_user')->on('users');    
            $table->foreign('id_server')->references('id_user')->on('users')->where('id_role', 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
