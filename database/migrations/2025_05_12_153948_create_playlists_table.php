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
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Playlist adı
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kullanıcıyla ilişki
            $table->string('cover_image')->nullable(); // Playlist cover image
            $table->text('description')->nullable(); // Playlist açıklaması
            $table->integer('likes_count')->default(0); // Beğeni sayısı
            $table->boolean('is_public')->default(true); // Playlist'in herkese açık olup olmadığı
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};
