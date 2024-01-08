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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->unsignedBigInteger('id_lokasi');
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasis')->default(1);
            $table->dateTime('tanggal_booking');
            $table->string('status');
            $table->unsignedBigInteger('id_voucher');
            $table->foreign('id_voucher')->references('id_voucher')->on('vouchers');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
