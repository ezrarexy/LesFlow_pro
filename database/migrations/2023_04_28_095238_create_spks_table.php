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
        Schema::create('spks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customers');
            $table->string('nama_pemakai', 50);
            $table->string('alamat', 100);
            $table->string('telp', 20)->unique();
            $table->unsignedBigInteger('id_mobil');
            $table->foreign('id_mobil')->references('id')->on('mobils');
            $table->decimal('harga_jadi', 10, 2);
            $table->unsignedBigInteger('id_jenis_pembayaran');
            $table->foreign('id_jenis_pembayaran')->references('id')->on('jenis_pembayarans');
            $table->unsignedBigInteger('id_leasing');
            $table->foreign('id_leasing')->references('id')->on('leasings');
            $table->decimal('uang_spk', 10, 2);
            $table->decimal('DP', 10, 2);
            $table->decimal('cicilan', 10, 2);
            $table->integer('tenor');
            $table->unsignedBigInteger('id_asuransi');
            $table->foreign('id_asuransi')->references('id')->on('asuransis');
            $table->unsignedBigInteger('id_jenis_asuransi');
            $table->foreign('id_jenis_asuransi')->references('id')->on('jenis_asuransis');
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spks');
    }
};
