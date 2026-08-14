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
        Schema::create('kategori_pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('pengumuman_kategori_pengumuman', function (Blueprint $table) {
            $table->foreignId('pengumuman_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kategori_pengumuman_id')->constrained()->cascadeOnDelete();
            $table->primary(['pengumuman_id', 'kategori_pengumuman_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pengumuman');
    }
};
