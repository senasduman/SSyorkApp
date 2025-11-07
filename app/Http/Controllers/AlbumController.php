<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{

    public function index()
    {
        // Fetch all public albums and the user's own albums
        $albums = Album::where('is_public', true)
            ->orWhere('user_id', Auth::id())
            ->with('songs') // Eager load songs for performance
            ->latest()
            ->get();

        return view('albums.index', compact('albums'));

    }

    public function show(Album $album)
    {
         $songs = $album->songs()->get();

        return view('albums.show', compact('album', 'songs'));
    }
    /**
     * Show the form for creating a new album.
     */
    public function create()
    {
        $this->authorizeArtist();

        return view('albums.create');
    }

    /**
     * Store a newly created album in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeArtist();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $data = $request->only(['title', 'description']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $filename = time() . '_' . $coverImage->getClientOriginalName();
            $filePath = $coverImage->storeAs('albums/covers', $filename, 'public');
            $data['cover_image'] = $filePath;
        }

        Album::create($data);

        return redirect()->route('dashboard')->with('success', 'Album created successfully.');
    }

    /**
     * Show the form for editing the specified album.
     */
    public function edit(Album $album)
    {
        $this->authorizeArtist();

        if ($album->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this album.');
        }

        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified album in storage.
     */
    public function update(Request $request, Album $album)
    {
        $this->authorizeArtist();

        if ($album->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to update this album.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('cover_image')) {
            // Delete the old cover image if it exists
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }

            $coverImage = $request->file('cover_image');
            $filename = time() . '_' . $coverImage->getClientOriginalName();
            $filePath = $coverImage->storeAs('albums/covers', $filename, 'public');
            $data['cover_image'] = $filePath;
        }

        $album->update($data);

        return redirect()->route('dashboard')->with('success', 'Album updated successfully.');
    }

    /**
     * Remove the specified album from storage.
     */
    public function destroy(Album $album)
    {
        $this->authorizeArtist();

        if ($album->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this album.');
        }

        // Delete the cover image if it exists
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }

        $album->delete();

        return redirect()->route('dashboard')->with('success', 'Album deleted successfully.');
    }

    /**
     * Ensure the user is an artist.
     */
    private function authorizeArtist()
    {
        if (!Auth::user()->is_artist) {
            abort(403, 'Only artists can manage albums.');
        }
    }

    public function addSong(Request $request, Album $album)
    {
        $this->authorizeArtist();

        if ($album->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to add songs to this album.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:mp3,wav|max:10240', // Max 10MB
        ]);

        $filePath = $request->file('file')->store('songs', 'public');

        $album->songs()->create([
            'title' => $request->title,
            'path' => $filePath,
            'duration' => $request->duration, // Optional: Calculate duration from the file
        ]);

        return redirect()->route('albums.edit', $album)->with('success', 'Song added successfully.');
    }





}
