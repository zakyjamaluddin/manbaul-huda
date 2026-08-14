<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('nama_madrasah');
            $table->string('tagline')->nullable();
            $table->text('alamat');
            $table->string('nama_kepala_madrasah');
            $table->longText('sambutan_kepala');
            $table->text('visi');
            $table->longText('sejarah_singkat');
            $table->string('email');
            $table->string('link_gmaps')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_fb')->nullable();
            $table->string('link_youtube')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
