<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->boolean('is_disematkan')->default(false); // Hanya 1 yang boleh disematkan
            $table->timestamps();
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
