<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->string('link_instagram')->nullable()->after('link_youtube');
            $table->foreignId('kaldik_blog_id')->nullable()->constrained('blogs')->nullOnDelete();
            $table->foreignId('program_unggulan_blog_id')->nullable()->constrained('blogs')->nullOnDelete();
            $table->foreignId('ekstrakurikuler_blog_id')->nullable()->constrained('blogs')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->dropForeign(['kaldik_blog_id']);
            $table->dropForeign(['program_unggulan_blog_id']);
            $table->dropForeign(['ekstrakurikuler_blog_id']);
            $table->dropColumn(['link_instagram', 'kaldik_blog_id', 'program_unggulan_blog_id', 'ekstrakurikuler_blog_id']);
        });
    }
};