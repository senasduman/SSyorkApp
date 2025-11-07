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
        Schema::table('songs', function (Blueprint $table) {
            // Önce foreign key constraint'i kaldır
            if (Schema::hasColumn('songs', 'playlist_id')) {
                $table->dropForeign(['playlist_id']);
            }

            // Sonra ilgili kolonları kaldır
            $table->dropColumn(['album_name', 'artist_name', 'playlist_id']);

            // Eğer album_id sütunu mevcut değilse, ekle
            if (!Schema::hasColumn('songs', 'album_id')) {
                $table->foreignId('album_id')->after('title')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            // Albüm ile ilgili kolon kaldırılır
            if (Schema::hasColumn('songs', 'album_id')) {
                $table->dropForeign(['album_id']);
                $table->dropColumn('album_id');
            }

            // Eski kolonlar geri eklenir
            $table->string('album_name')->nullable();
            $table->string('artist_name')->nullable();

            // Playlist foreign key alanı geri eklenir
            $table->foreignId('playlist_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
