<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_galeris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('foto');
            $table->timestamps();
        });

        Schema::create('galeri_kategori_galeri', function (Blueprint $table) {
            $table->foreignId('galeri_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kategori_galeri_id')->constrained()->cascadeOnDelete();
            $table->primary(['galeri_id', 'kategori_galeri_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_kategori_galeri');
        Schema::dropIfExists('galeris');
        Schema::dropIfExists('kategori_galeris');
    }
};
