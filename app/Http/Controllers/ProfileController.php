<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\Album;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Temel alanları dolduralım
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        $user->is_artist = $request->boolean('is_artist');

        // Profil Fotoğrafı Güncellemesi
        if ($request->hasFile('profile_photo')) {
            // Eski fotoğrafı sil
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Yeni fotoğrafı kaydet
            $file = $request->file('profile_photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $user->profile_photo = $path;
        }

        // E-posta değişikliği kontrolü
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        // Değişiklikleri kaydet
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');


    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function dashboard(): View
    {
        // Fetch all albums from the database
        $albums = Album::with('user')->get();

        // Pass the albums to the dashboard view
        return view('dashboard', compact('albums'));
    }

    public function show()
    {
        $user = Auth::user();

        // Assuming relationships exist for playlists and albums
        $playlists = $user->playlists; // Replace with actual relationship
        $albums = $user->albums; // Replace with actual relationship

        return view('profile.profile', compact('user', 'playlists', 'albums'));
    }


        public function viewProfile(User $user)
    {
        // Get user's playlists (only public ones or all if it's the current user)
        $playlists = $user->playlists()
            ->when(Auth::id() !== $user->id, function ($query) {
                // Add public filter if you have a 'is_public' column
                // $query->where('is_public', true);
            })
            ->get();

        // Get user's albums if they're an artist
        $albums = $user->is_artist ? $user->albums()->get() : collect();

        return view('profile.public', [
            'user' => $user,
            'playlists' => $playlists,
            'albums' => $albums,
            'isOwnProfile' => Auth::id() === $user->id
        ]);
    }


}
