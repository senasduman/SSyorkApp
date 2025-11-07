<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Albums') }}
        </h2>
    </x-slot>

    <style>
        :root {
            --primary-bg: #121828;
            --secondary-bg: #1F2A40;
            --sidebar-bg: #2A3A5E;
            --accent-color: #4A90E2;
            --text-primary: #E0E0E0;
            --text-secondary: #B0B0B0;
            --icon-color: #B0B0B0;
            --hover-bg: #3A4C7A;
            --border-color: #3A4C7A;
        }

        .page-container {
            background: var(--primary-bg);
            min-height: 100vh;
        }

        .content-card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }

        .album-card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .album-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: var(--accent-color);
        }

        .album-image {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .album-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.3) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .album-card:hover .album-image::after {
            opacity: 1;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .album-card:hover .play-button {
            opacity: 1;
        }

        .play-button:hover {
            transform: translate(-50%, -50%) scale(1.1);
            background: #5A9FE5;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            padding: 12px 16px;
            background: var(--hover-bg);
            border-top: 1px solid var(--border-color);
        }

        .action-btn {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-view {
            background: var(--accent-color);
            color: white;
        }

        .btn-view:hover {
            background: #5A9FE5;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: rgba(251, 191, 36, 0.9);
            color: white;
        }

        .btn-edit:hover {
            background: rgba(251, 191, 36, 1);
            transform: translateY(-2px);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.9);
            color: white;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 1);
            transform: translateY(-2px);
        }

        .create-btn {
            background: linear-gradient(135deg, var(--accent-color) 0%, #5A9FE5 100%);
            transition: all 0.3s ease;
        }

        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(74, 144, 226, 0.4);
        }

        .empty-state {
            background: var(--secondary-bg);
            border: 2px dashed var(--border-color);
        }

        .album-info {
            padding: 16px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-artist {
            background: rgba(74, 144, 226, 0.2);
            color: var(--accent-color);
            border: 1px solid rgba(74, 144, 226, 0.3);
        }

        .song-count {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .album-header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .album-title {
            flex: 1;
            margin-right: 8px;
        }

        .artist-link {
            transition: all 0.3s ease;
        }

        .artist-link:hover {
            color: var(--accent-color) !important;
            text-decoration: underline;
        }
    </style>

    <div class="py-12 page-container">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl content-card rounded-3xl">
                <div class="p-8">
                    <!-- Header Section -->
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h1 class="flex items-center text-3xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-4xl">🎼</span>
                                {{ __('Your Albums') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Manage and showcase your music albums
                            </p>
                        </div>
                        @if(Auth::user()->is_artist)
                            <a href="{{ route('albums.create') }}"
                               class="inline-flex items-center px-6 py-3 font-semibold text-white shadow-lg create-btn rounded-xl hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Create Album') }}
                            </a>
                        @endif
                    </div>

                    <!-- Stats Bar -->
                    <div class="grid grid-cols-3 gap-6 p-6 mb-8 rounded-2xl" style="background: var(--hover-bg); border: 1px solid var(--border-color);">
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: var(--text-primary);">{{ $albums->count() }}</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Total Albums</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: var(--text-primary);">{{ $albums->where('created_at', '>=', now()->subMonth())->count() }}</div>
                            <div class="text-sm" style="color: var(--text-secondary);">This Month</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: var(--text-primary);">{{ $albums->sum(function($album) { return $album->songs->count(); }) }}</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Total Songs</div>
                        </div>
                    </div>

                    <!-- Albums Grid -->
                    @if ($albums->isEmpty())
                        <div class="py-20 text-center empty-state rounded-3xl">
                            <div class="mb-6 text-8xl">🎼</div>
                            <h3 class="mb-4 text-2xl font-bold" style="color: var(--text-primary);">
                                {{ __('No albums yet') }}
                            </h3>
                            <p class="mb-8 text-lg" style="color: var(--text-secondary);">
                                @if(Auth::user()->is_artist)
                                    {{ __('Create your first album to start sharing your music with the world!') }}
                                @else
                                    {{ __('You need to be an artist to create albums.') }}
                                @endif
                            </p>
                            @if(Auth::user()->is_artist)
                                <a href="{{ route('albums.create') }}"
                                   class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white create-btn rounded-2xl">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('Create Your First Album') }}
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            @foreach ($albums as $album)
                                <div class="overflow-hidden shadow-lg album-card rounded-2xl">
                                    <!-- Album Cover -->
                                    <div class="album-image" onclick="viewAlbum('{{ route('albums.show', $album->id) }}')">
                                        @if ($album->cover_image)
                                            <img src="{{ asset('storage/' . $album->cover_image) }}"
                                                 alt="{{ $album->title }}"
                                                 class="object-cover w-full h-48">
                                        @else
                                            <div class="flex items-center justify-center w-full h-48 bg-gradient-to-br from-gray-600 via-gray-700 to-gray-800">
                                                <div class="text-6xl text-white opacity-80">🎼</div>
                                            </div>
                                        @endif

                                        <!-- Play Button -->
                                        <button class="play-button" onclick="event.stopPropagation(); playAlbum('{{ $album->id }}')">
                                            <svg class="w-6 h-6 ml-1 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Album Info -->
                                    <div class="album-info">
                                        <div class="album-header">
                                            <div class="album-title">
                                                <h4 class="text-lg font-bold truncate" style="color: var(--text-primary);">
                                                    {{ $album->title }}
                                                </h4>
                                            </div>
                                            <span class="badge badge-artist">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                                Artist
                                            </span>
                                        </div>

                                        <!-- Artist Info -->
                                        <div class="mb-2">
                                            <a href="{{ route('users.profile', $album->user) }}"
                                               class="text-sm artist-link"
                                               style="color: var(--text-secondary);">
                                                By {{ $album->user->name ?? 'Unknown Artist' }}
                                            </a>
                                        </div>

                                        @if($album->description)
                                            <p class="mb-3 text-sm line-clamp-2" style="color: var(--text-secondary);">
                                                {{ Str::limit($album->description, 80) }}
                                            </p>
                                        @endif

                                        <div class="flex items-center justify-between mb-3">
                                            <div class="song-count">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                                                </svg>
                                                <span>{{ $album->songs->count() ?? 0 }} songs</span>
                                            </div>

                                            <div class="text-xs" style="color: var(--text-secondary);">
                                                {{ $album->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons Section -->
                                    <div class="action-buttons">
                                        <!-- View Button -->
                                        <a href="{{ route('albums.show', $album->id) }}"
                                           class="action-btn btn-view">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>

                                        @if(Auth::id() === $album->user_id)
                                            <!-- Edit Button -->
                                            <a href="{{ route('albums.edit', $album->id) }}"
                                               class="action-btn btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('albums.destroy', $album->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this album?') }}')"
                                                  class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-full action-btn btn-delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function playAlbum(albumId) {
            console.log('Playing album:', albumId);
            // Add your album play functionality here
            // You can fetch the first song from the album and play it
        }

        function viewAlbum(url) {
            window.location.href = url;
        }

        // Add smooth scroll behavior for better UX
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.album-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</x-app-layout>
