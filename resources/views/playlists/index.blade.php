<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Playlists') }}
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

        .playlist-card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .playlist-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: var(--accent-color);
        }

        .playlist-image {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .playlist-image::after {
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

        .playlist-card:hover .playlist-image::after {
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

        .playlist-card:hover .play-button {
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

        .playlist-info {
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

        .badge-public {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-private {
            background: rgba(156, 163, 175, 0.2);
            color: #9ca3af;
            border: 1px solid rgba(156, 163, 175, 0.3);
        }

        .song-count {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .playlist-header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .playlist-title {
            flex: 1;
            margin-right: 8px;
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
                                <span class="mr-3 text-4xl">🎵</span>
                                {{ __('Your Music Library') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Manage and organize your playlists
                            </p>
                        </div>
                        <a href="{{ route('playlists.create') }}"
                           class="inline-flex items-center px-6 py-3 font-semibold text-white shadow-lg create-btn rounded-xl hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Create Playlist') }}
                        </a>
                    </div>

                    <!-- Stats Bar -->
                    <div class="grid grid-cols-3 gap-6 p-6 mb-8 rounded-2xl" style="background: var(--hover-bg); border: 1px solid var(--border-color);">
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: var(--text-primary);">{{ $playlists->count() }}</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Total Playlists</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: var(--text-primary);">{{ $playlists->where('is_public', true)->count() }}</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Public</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" style="color: var(--text-primary);">{{ $playlists->sum(function($playlist) { return $playlist->songs->count(); }) }}</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Total Songs</div>
                        </div>
                    </div>

                    <!-- Playlists Grid -->
                    @if ($playlists->isEmpty())
                        <div class="py-20 text-center empty-state rounded-3xl">
                            <div class="mb-6 text-8xl">🎵</div>
                            <h3 class="mb-4 text-2xl font-bold" style="color: var(--text-primary);">
                                {{ __('No playlists yet') }}
                            </h3>
                            <p class="mb-8 text-lg" style="color: var(--text-secondary);">
                                {{ __('Create your first playlist to start organizing your favorite music!') }}
                            </p>
                            <a href="{{ route('playlists.create') }}"
                               class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white create-btn rounded-2xl">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Create Your First Playlist') }}
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            @foreach ($playlists as $playlist)
                                <div class="overflow-hidden shadow-lg playlist-card rounded-2xl">
                                    <!-- Playlist Cover -->
                                    <div class="playlist-image" onclick="viewPlaylist('{{ route('playlists.show', $playlist->id) }}')">
                                        @if ($playlist->cover_image)
                                            <img src="{{ asset('storage/' . $playlist->cover_image) }}"
                                                 alt="{{ $playlist->name }}"
                                                 class="object-cover w-full h-48">
                                        @else
                                            <div class="flex items-center justify-center w-full h-48 bg-gradient-to-br from-purple-500 via-blue-500 to-indigo-600">
                                                <div class="text-6xl text-white opacity-80">🎵</div>
                                            </div>
                                        @endif

                                        <!-- Play Button -->
                                        <button class="play-button" onclick="event.stopPropagation(); playPlaylist('{{ $playlist->id }}')">
                                            <svg class="w-6 h-6 ml-1 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Playlist Info -->
                                    <div class="playlist-info">
                                        <div class="playlist-header">
                                            <div class="playlist-title">
                                                <h4 class="text-lg font-bold truncate" style="color: var(--text-primary);">
                                                    {{ $playlist->name }}
                                                </h4>
                                            </div>
                                            <span class="badge {{ $playlist->is_public ? 'badge-public' : 'badge-private' }}">
                                                {{ $playlist->is_public ? __('Public') : __('Private') }}
                                            </span>
                                        </div>

                                        @if($playlist->description)
                                            <p class="mb-3 text-sm line-clamp-2" style="color: var(--text-secondary);">
                                                {{ Str::limit($playlist->description, 80) }}
                                            </p>
                                        @endif

                                        <div class="flex items-center justify-between mb-3">
                                            <div class="song-count">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                                                </svg>
                                                <span>{{ $playlist->songs->count() ?? 0 }} songs</span>
                                            </div>

                                            @if(isset($playlist->likes_count))
                                                <div class="flex items-center gap-1 text-xs" style="color: var(--text-secondary);">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                    </svg>
                                                    {{ $playlist->likes_count }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Action Buttons Section -->
                                    <div class="action-buttons">
                                        <!-- View Button -->
                                        <a href="{{ route('playlists.show', $playlist->id) }}"
                                           class="action-btn btn-view">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('playlists.edit', $playlist->id) }}"
                                           class="action-btn btn-edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('playlists.destroy', $playlist->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('{{ __('Are you sure you want to delete this playlist?') }}')"
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
        function playPlaylist(playlistId) {
            console.log('Playing playlist:', playlistId);
            // Add your playlist play functionality here
            // You can fetch the first song from the playlist and play it
        }

        function viewPlaylist(url) {
            window.location.href = url;
        }

        // Add smooth scroll behavior for better UX
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.playlist-card');
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
