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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id('id_voucher');
            $table->string('kode_voucher')->unique();
            $table->text('description')->nullable();
            $table->integer('diskon');
            $table->integer('minimal_pembayaran');
            $table->dateTime('tanggal_mulai_berlaku');
            $table->dateTime('tanggal_berakhir_berlaku');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
