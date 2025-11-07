<?php
// filepath: app/Http/Controllers/PlaylistLikeController.php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use App\Models\PlaylistLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistLikeController extends Controller
{
    public function toggle(Playlist $playlist)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to like playlists'
            ], 401);
        }

        // Check if playlist is public or belongs to user
        if (!$playlist->is_public && $playlist->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot like this private playlist'
            ], 403);
        }

        $existingLike = PlaylistLike::where('user_id', $user->id)
                                   ->where('playlist_id', $playlist->id)
                                   ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
            $message = 'Playlist removed from favorites';
        } else {
            // Like
            PlaylistLike::create([
                'user_id' => $user->id,
                'playlist_id' => $playlist->id,
            ]);
            $liked = true;
            $message = 'Playlist added to favorites';
        }

        $likesCount = $playlist->likes()->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount,
            'message' => $message
        ]);
    }

    public function index()
    {
        $user = Auth::user();
        $likedPlaylists = $user->likedPlaylists()
                              ->with(['user', 'songs'])
                              ->paginate(12);

        return view('playlists.liked', compact('likedPlaylists'));
    }
}
