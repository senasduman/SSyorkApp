<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $playlistId = $request->query('playlist_id');
        $songsQuery = Song::query();

        if ($playlistId) {
            $playlist = Playlist::findOrFail($playlistId);
            // Yetkilendirme (playlist public değilse ve sahibi değilse şarkıları gösterme)
            if (!$playlist->is_public && $playlist->user_id !== Auth::id()) {
                abort(403);
            }
            $songsQuery->where('playlist_id', $playlistId);
        } else {
            // Genel şarkı listesi (belki sadece kullanıcının yüklediği veya beğendiği şarkılar)
            // Bu kısım uygulamanızın mantığına göre değişir.
            // Örnek: Tüm şarkılar (genellikle bu istenmez, bir filtreleme olmalı)
            // $songsQuery = Song::query();
            return redirect()->route('playlists.index')->with('info', 'Lütfen bir çalma listesi seçin.');
        }

        $songs = $songsQuery->latest()->paginate(15);
        return view('songs.index', compact('songs', 'playlistId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $playlists = Playlist::where('user_id', Auth::id())->get();
        $selectedPlaylistId = $request->query('playlist_id');
        return view('songs.create', compact('playlists', 'selectedPlaylistId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'album_name' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'path' => 'required|file|mimes:mp3,wav,aac|max:10240', // Örnek: 10MB max
            'duration' => 'nullable|integer', // Süre saniye cinsinden
            'playlist_id' => 'required|exists:playlists,id',
        ]);

        // Playlist'in kullanıcıya ait olup olmadığını kontrol et
        $playlist = Playlist::findOrFail($request->playlist_id);
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Bu çalma listesine şarkı ekleyemezsiniz.');
        }

        $data = $request->except('path'); // path'i ayrı işleyeceğiz

        if ($request->hasFile('path')) {
            // Şarkı dosyasını yükle
            // Örnek: songs/playlist_id/şarkı_adı.mp3
            $songFile = $request->file('path');
            $filename = time() . '_' . $songFile->getClientOriginalName();
            $filePath = $songFile->storeAs('songs/' . $request->playlist_id, $filename, 'public');
            $data['path'] = $filePath;
        }

        // Duration (süre) bilgisini dosyadan almak daha iyi bir pratik olabilir.
        // Şimdilik kullanıcıdan alıyoruz veya null bırakıyoruz.
        // $data['duration'] = $request->duration ?? $this->getAudioDuration($filePath); // Örnek

        Song::create($data);

        return redirect()->route('playlists.show', $request->playlist_id)->with('success', 'Şarkı başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        // Şarkı detaylarını göster
        // Yetkilendirme (örneğin şarkının ait olduğu playlist public değilse ve sahibi değilse)
        $playlist = $song->playlist;
        if ($playlist && !$playlist->is_public && $playlist->user_id !== Auth::id()) {
            abort(403);
        }
        return view('songs.show', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $playlist = $song->playlist;
        if (!$playlist || $playlist->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'album_name' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            // path güncellemesi genellikle yapılmaz, şarkı silinip yeniden eklenir.
            // 'path' => 'nullable|file|mimes:mp3,wav,aac|max:10240',
            'duration' => 'nullable|integer',
            'playlist_id' => 'required|exists:playlists,id',
        ]);

        // Yeni playlist'in de kullanıcıya ait olup olmadığını kontrol et
        $newPlaylist = Playlist::findOrFail($request->playlist_id);
        if ($newPlaylist->user_id !== Auth::id()) {
            abort(403, 'Bu çalma listesine şarkı taşıyamazsınız.');
        }

        $data = $request->all();
        // Path güncellemesi isteniyorsa buraya eklenebilir, ancak dikkatli olunmalı.

        $song->update($data);

        return redirect()->route('playlists.show', $song->playlist_id)->with('success', 'Şarkı başarıyla güncellendi.');
    }

    //Liked Song
     public function likeSong(Song $song)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Kullanıcının "Liked Music" playlistini bul
        $likedPlaylist = $user->playlists()->where('is_liked', true)->first();

        if (!$likedPlaylist) {
            return redirect()->back()->with('error', 'Liked Music playlisti bulunamadı.');
        }

        // Şarkıyı "Liked Music" playlistine ekle
        $likedPlaylist->songs()->syncWithoutDetaching($song->id);

        return redirect()->back()->with('success', 'Şarkı Liked Music playlistine eklendi.');
    }

    /**
     * Şarkıyı beğenmekten vazgeç ve "Liked Music" playlistinden kaldır.
     */
    public function unlikeSong(Song $song)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Kullanıcının "Liked Music" playlistini bul
        $likedPlaylist = $user->playlists()->where('is_liked', true)->first();

        if (!$likedPlaylist) {
            return redirect()->back()->with('error', 'Liked Music playlisti bulunamadı.');
        }

        // Şarkıyı "Liked Music" playlistinden kaldır
        $likedPlaylist->songs()->detach($song->id);

        return redirect()->back()->with('success', 'Şarkı Liked Music playlistinden kaldırıldı.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        // Check if the song belongs to an album
    $album = $song->album;

    if ($album && $album->user_id !== Auth::id()) {
        abort(403, 'You are not authorized to delete this song.');
    }

    // Check if the song belongs to a playlist
    $playlist = $song->playlist;

    if ($playlist && $playlist->user_id !== Auth::id()) {
        abort(403, 'You are not authorized to delete this song.');
    }

    // Delete the song file from storage if it exists
    if ($song->path) {
        Storage::disk('public')->delete($song->path);
    }

    // Delete the song record
    $song->delete();

    return redirect()->back()->with('success', 'Song deleted successfully.');
    }
}
