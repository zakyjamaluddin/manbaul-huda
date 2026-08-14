<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->string('thumbnail');
            $table->boolean('is_disematkan')->default(false);
            $table->timestamps();
        });

        Schema::create('blog_kategori_blog', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kategori_blog_id')->constrained()->cascadeOnDelete();
            $table->primary(['blog_id', 'kategori_blog_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_kategori_blog');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('kategori_blogs');
    }
};
