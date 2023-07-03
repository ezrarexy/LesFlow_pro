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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->char('jk', 1);
            $table->string('nik', 20)->unique();
            $table->date('dob');
            $table->string('alamat', 100);
            $table->unsignedBigInteger('id_agama');
            $table->foreign('id_agama')->references('id')->on('agamas');
            $table->string('telp', 20)->unique();
            $table->binary('photo_ktp');
            $table->string('instagram', 50);
            $table->string('facebook', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
