@props(['user'])

@if(Auth::check() && Auth::id() !== $user->id)
    @if(Auth::user()->isFollowing($user))
        <form action="{{ route('users.unfollow', $user) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg hover:bg-red-600"
                    style="background: #ef4444;">
                Unfollow
            </button>
        </form>
    @else
        <form action="{{ route('users.follow', $user) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg hover:bg-blue-600"
                    style="background: var(--accent-color);">
                Follow
            </button>
        </form>
    @endif
@endif
