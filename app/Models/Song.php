<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'album_name', 'artist_name', 'path', 'duration', 'playlist_id'];


     // Şarkının ait olduğu albüm
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    // Şarkının bulunduğu playlistler
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class)->withTimestamps();
    }

    // Şarkıyı beğenen kullanıcılar
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }



}
