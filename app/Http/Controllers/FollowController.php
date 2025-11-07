<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = Auth::user();

        // Prevent users from following themselves
        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        // Check if already following
        if ($currentUser->followings()->where('following_id', $user->id)->exists()) {
            return back()->with('info', 'You are already following this user.');
        }

        // Follow the user
        $currentUser->followings()->attach($user->id);

        return back()->with('success', 'You are now following ' . $user->name);
    }

    /**
     * Unfollow a user
     */
    public function unfollow(User $user)
    {
        $currentUser = Auth::user();

        // Check if following
        if (!$currentUser->followings()->where('following_id', $user->id)->exists()) {
            return back()->with('info', 'You are not following this user.');
        }

        // Unfollow the user
        $currentUser->followings()->detach($user->id);

        return back()->with('success', 'You unfollowed ' . $user->name);
    }

    /**
     * Show followers of a user
     */
    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(20);

        return view('follow.followers', compact('user', 'followers'));
    }

    /**
     * Show users that a user is following
     */
    public function following(User $user)
    {
        $following = $user->followings()->paginate(20);

        return view('follow.following', compact('user', 'following'));
    }
}
