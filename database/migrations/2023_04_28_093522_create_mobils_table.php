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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_merk');
            $table->foreign('id_merk')->references('id')->on('merks');
            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id')->on('jenis');
            $table->string('nama', 50);
            $table->year('tahun');
            $table->string('warna', 20);
            $table->string('nomor_bpkb', 20)->unique();
            $table->string('an_bpkb', 50);
            $table->string('ktp_an_bpkb', 20);
            $table->string('nomor_rangka', 50)->unique();
            $table->string('nomor_mesin', 50)->unique();
            $table->string('nomor_polisi', 20)->unique();
            $table->date('jt_pkb');
            $table->date('jt_stnk');
            $table->string('status', 20);
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customers');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('harga_bottom', 10, 2);
            $table->decimal('harga_jual', 10, 2);
            $table->binary('photo_bpkb');
            $table->binary('photo_pkb');
            $table->binary('photo_stnk');
            $table->string('code', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
