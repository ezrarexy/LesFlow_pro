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
        Schema::create('bengkels', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('pic', 50);
            $table->string('telp', 20)->unique();
            $table->string('alamat', 100);
            $table->unsignedBigInteger('id_jenis_bengkel');
            $table->foreign('id_jenis_bengkel')->references('id')->on('jenis_bengkels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bengkels');
    }
};
