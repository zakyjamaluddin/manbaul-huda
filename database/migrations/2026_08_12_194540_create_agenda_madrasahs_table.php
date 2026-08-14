<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda_madrasahs', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Contoh: Upacara HUT RI, STS, ASAS, Rejeban/Muludan
            $table->date('tanggal_pelaksanaan');
            $table->string('kategori'); // Rutin / Ujian / Peringatan Hari Besar
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->default('Kompleks MI Manba\'ul Huda');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_madrasahs');
    }
};