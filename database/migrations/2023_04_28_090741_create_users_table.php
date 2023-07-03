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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id')->on('roles');
            $table->string('nama', 50);
            $table->char('jk', 1);
            $table->date('dob');
            $table->string('nik', 20)->unique();
            $table->string('alamat', 100);
            $table->unsignedBigInteger('id_agama');
            $table->foreign('id_agama')->references('id')->on('agamas');
            $table->string('telp', 20)->unique();
            $table->string('email', 50)->unique();
            $table->decimal('gaji_pokok', 10, 2);
            $table->binary('photo_ktp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
