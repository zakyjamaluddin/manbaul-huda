<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_siswa_barus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nisn')->nullable();
            $table->string('asal_sekolah');
            $table->string('nama_orangtua');
            $table->string('nomor_whatsapp_orangtua');
            $table->text('alamat_lengkap');
            $table->enum('status', ['pending', 'diverifikasi', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_siswa_barus');
    }
};
