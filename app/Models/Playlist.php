<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'cover_image', 'description', 'likes_count', 'is_public', 'is_liked'
    ];


    // Playlistin sahibi olan kullanıcı
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song')->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany(PlaylistLike::class);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'playlist_likes')->withTimestamps();
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

}
