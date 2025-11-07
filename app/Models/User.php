<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'is_artist',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_artist' => 'boolean',
    ];

    // Kullanıcının oluşturduğu playlistler
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    // Kullanıcının oluşturduğu albümler (eğer sanatçıysa)
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    // Kullanıcının beğendiği şarkılar (Liked Music)
    public function likedSongs()
    {
        return $this->belongsToMany(Song::class, 'liked_songs', 'user_id', 'song_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'following_id', 'follower_id')->withTimestamps();
    }


    // Playlist likes relationships
    public function playlistLikes()
    {
        return $this->hasMany(PlaylistLike::class);
    }

    public function likedPlaylists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_likes')
                    ->withTimestamps()
                    ->withPivot('created_at')
                    ->orderByPivot('created_at', 'desc');
    }


    //Kullanıcı oluşturulduğunda otomatik olarak bir liked Music playlisti oluşturma.
    protected static function booted()
    {
        static::created(function ($user) {
            $user->playlists()->create([
                'name' => 'Liked Music',
                'is_public' => false,
                'is_liked' => true,
            ]);
        });
    }

    public function addSongToLikedMusic(Song $song)
    {
        $likedPlaylist = $this->playlists()->where('is_liked', true)->first();

        if ($likedPlaylist) {
            $likedPlaylist->songs()->syncWithoutDetaching($song->id);
        }
    }


        public function isFollowing(User $user)
    {
        return $this->followings()->where('following_id', $user->id)->exists();
    }

    /**
     * Check if this user is followed by another user
     */
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    /**
     * Get followers count
     */
    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    /**
     * Get following count
     */
    public function getFollowingCountAttribute()
    {
        return $this->followings()->count();
    }




}
