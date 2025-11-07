<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::where('user_id', Auth::id())->latest()->paginate(10);
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_public' => 'nullable|boolean', // Make it nullable to handle unchecked checkboxes
            'is_liked' => 'nullable|boolean', // Same for is_liked
        ]);

        $data = $request->only(['name', 'description', 'is_public']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $filename = time() . '_' . $coverImage->getClientOriginalName();
            $filePath = $coverImage->storeAs('playlists/covers', $filename, 'public');
            $data['cover_image'] = $filePath;
        }

        Playlist::create($data);

        return redirect()->route('playlists.index')->with('success', 'Playlist created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        if (!$playlist->is_public) {
        // If user is not logged in
        if (!auth()->check()) {
            return redirect()->route('dashboard')->with('error', 'This playlist is private. Please log in to access it.');
        }

        // If user is not the owner
        if ($playlist->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'This playlist is private and you don\'t have permission to view it.');
        }
    }

    // If access is allowed, continue with normal logic
    $playlist->load(['user', 'songs.album.user']);

    return view('playlists.show', compact('playlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }
        // Fetch albums - you might want to refine this query, e.g., only public albums or user's albums
        $allAlbums = Album::with('songs')->get(); // Eager load songs to pass to JavaScript
        return view('playlists.edit', compact('playlist', 'allAlbums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
        abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_public' => 'required|boolean',
        ]);

        $data = $request->only(['name', 'description', 'is_public']);

        if ($request->hasFile('cover_image')) {
            // Delete the old cover image if it exists
            if ($playlist->cover_image) {
                Storage::disk('public')->delete($playlist->cover_image);
            }

            $coverImage = $request->file('cover_image');
            $filename = time() . '_' . $coverImage->getClientOriginalName();
            $filePath = $coverImage->storeAs('playlists/covers', $filename, 'public');
            $data['cover_image'] = $filePath;
        }

        // Update the playlist with the validated data
        $playlist->update($data);

        return redirect()->route('playlists.show', $playlist)->with('success', 'Playlist başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        // İlişkili cover image'ı sil (varsa)
        if ($playlist->cover_image) {
            Storage::disk('public')->delete($playlist->cover_image);
        }

        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist başarıyla silindi.');
    }


    /**
     * Add selected songs from an album to the playlist.
     */
    public function addAlbumSongs(Request $request, Playlist $playlist)
    {
        // Authorization: Ensure the user owns the playlist
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to modify this playlist.');
        }

        $request->validate([
            'song_ids' => 'required|array',
            'song_ids.*' => 'required|exists:songs,id', // Ensure all song IDs exist in the songs table
        ]);

        $songIds = $request->input('song_ids');

        // Attach songs to the playlist.
        // syncWithoutDetaching adds new songs without removing existing ones
        // and avoids duplicates if your pivot table has a unique constraint.
        $playlist->songs()->syncWithoutDetaching($songIds);

        return redirect()->route('playlists.edit', $playlist)->with('success', 'Selected songs have been added to the playlist.');
    }

    public function removeSong(Request $request, Playlist $playlist, Song $song)
    {
        // Log the critical information
        \Illuminate\Support\Facades\Log::debug('PlaylistController@removeSong: Attempting to remove song.', [
            'authenticated_user_id' => Auth::id(),
            'playlist_id' => $playlist->id,
            'playlist_name' => $playlist->name,
            'playlist_user_id' => $playlist->user_id,
            'playlist_is_liked_flag' => $playlist->is_liked, // From your Playlist model
            'song_id' => $song->id,
            'song_title' => $song->title,
            'request_url' => $request->fullUrl(),
        ]);

        // Authorization: User must own the playlist to modify it.
        if ($playlist->user_id !== Auth::id()) {
            \Illuminate\Support\Facades\Log::error('PlaylistController@removeSong: Authorization failed.', [
                'reason' => 'Playlist user_id does not match authenticated user_id.',
                'playlist_user_id' => $playlist->user_id,
                'authenticated_user_id' => Auth::id(),
            ]);
            abort(403, 'You are not authorized to modify this playlist.');
        }

        // Attempt to detach the song
        $detachedCount = $playlist->songs()->detach($song->id);

        if ($playlist->is_liked) {
            Auth::user()->likedSongs()->detach($song->id);
        }

        if ($detachedCount > 0) {
            return back()->with('success', __('Song removed from playlist.'));
        } else {
            return back()->with('info', __('Song was not found in this playlist or could not be removed.'));
        }
    }

    public function likedMusic()
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Fetch the "Liked Music" playlist
        $likedMusicPlaylist = $user->playlists()->where('is_liked', true)->first();

        if (!$likedMusicPlaylist) {
            return redirect()->route('dashboard')->with('error', 'Liked Music playlist not found.');
        }

        // Pass the playlist to a view
        return view('playlists.show', ['playlist' => $likedMusicPlaylist]);
    }
}
