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
        Schema::create('hari_rayas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_agama');
            $table->foreign('id_agama')->references('id')->on('agamas');
            $table->string('nama', 50);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hari_rayas');
    }
};
