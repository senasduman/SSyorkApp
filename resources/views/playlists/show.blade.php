<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $playlist->name }}
        </h2>
    </x-slot>

    @include('components.audio-player')

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

        .playlist-hero {
            background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
        }

        .album-cover {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .album-cover:hover {
            transform: scale(1.05);
        }

        .play-all-btn {
            background: var(--accent-color);
            transition: all 0.3s ease;
        }

        .play-all-btn:hover {
            background: #5A9FE5;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(74, 144, 226, 0.4);
        }

        .song-row {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .song-row:hover {
            background: var(--hover-bg);
            border-color: var(--accent-color);
            transform: translateX(5px);
        }

        .song-number {
            color: var(--text-secondary);
            font-weight: 600;
            min-width: 40px;
        }

        .duration-badge {
            background: rgba(74, 144, 226, 0.2);
            color: var(--accent-color);
            border: 1px solid var(--accent-color);
        }

        .stats-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Like Button Styles */
        .like-btn {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .like-btn:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
            transform: scale(1.1);
        }

        .like-btn.liked {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-color: #ef4444;
            color: white;
        }

        .like-btn.liked:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: scale(1.1);
        }

        .like-btn.liked .like-icon {
            animation: heartBeat 0.6s ease-in-out;
        }

        @keyframes heartBeat {
            0% { transform: scale(1); }
            14% { transform: scale(1.3); }
            28% { transform: scale(1); }
            42% { transform: scale(1.3); }
            70% { transform: scale(1); }
        }

        .action-btn {
            background: var(--hover-bg);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-color);
            transform: scale(1.05);
        }
    </style>

    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="min-h-screen" style="background: var(--primary-bg);">
        <!-- Hero Section -->
        <div class="playlist-hero">
            <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col items-start gap-8 lg:flex-row lg:items-end">
                    <!-- Album Cover -->
                    <div class="flex-shrink-0">
                        <div class="w-64 h-64 overflow-hidden shadow-2xl album-cover rounded-2xl">
                            @if($playlist->cover_image)
                                <img src="{{ asset('storage/' . $playlist->cover_image) }}"
                                     alt="{{ $playlist->name }}"
                                     class="object-cover w-full h-full">
                            @elseif($playlist->songs->first() && $playlist->songs->first()->album->cover_image)
                                <img src="{{ asset('storage/' . $playlist->songs->first()->album->cover_image) }}"
                                     alt="{{ $playlist->name }}"
                                     class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-purple-500 to-blue-600">
                                    <div class="text-6xl text-white">🎵</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Playlist Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-2">
                            <p class="text-sm font-medium" style="color: var(--text-secondary);">
                                PLAYLIST
                            </p>
                            @if($playlist->is_public)
                                <span class="px-2 py-1 text-xs font-medium rounded-full"
                                      style="background: rgba(34, 197, 94, 0.2); color: #22c55e; border: 1px solid #22c55e;">
                                    🌍 PUBLIC
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium rounded-full"
                                      style="background: rgba(156, 163, 175, 0.2); color: #9ca3af; border: 1px solid #9ca3af;">
                                    🔒 PRIVATE
                                </span>
                            @endif
                        </div>

                        <h1 class="mb-4 text-4xl font-bold lg:text-6xl" style="color: var(--text-primary);">
                            {{ $playlist->name }}
                        </h1>

                        @if($playlist->description)
                            <p class="mb-4 text-lg" style="color: var(--text-secondary);">
                                {{ $playlist->description }}
                            </p>
                        @endif

                        <div class="flex items-center gap-6 mb-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 overflow-hidden rounded-full">
                                    @if($playlist->user->profile_photo)
                                        <img src="{{ asset('storage/' . $playlist->user->profile_photo) }}"
                                             alt="{{ $playlist->user->name }}"
                                             class="object-cover w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-600 to-gray-800">
                                            <span class="text-sm text-white">{{ substr($playlist->user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <span class="font-medium" style="color: var(--text-primary);">
                                    {{ $playlist->user->name }}
                                </span>
                            </div>
                            <span style="color: var(--text-secondary);">•</span>
                            <span style="color: var(--text-secondary);">
                                {{ $playlist->songs->count() }} songs
                            </span>
                            <span style="color: var(--text-secondary);">•</span>
                            <span style="color: var(--text-secondary);">
                                {{ $playlist->likes()->count() }} likes
                            </span>
                            <span style="color: var(--text-secondary);">•</span>
                            <span style="color: var(--text-secondary);">
                                {{ $playlist->created_at->format('Y') }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-4">
                            @if(!$playlist->songs->isEmpty())
                                <button onclick="playPlaylist()"
                                        class="flex items-center gap-3 px-8 py-3 font-semibold text-white rounded-full play-all-btn">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    Play All
                                </button>
                            @endif

                            <!-- Like Button -->
                            @auth
                                @php
                                    $isLiked = $playlist->isLikedBy(auth()->user());
                                    $likesCount = $playlist->likes()->count();
                                @endphp
                                <button onclick="togglePlaylistLike({{ $playlist->id }}, this)"
                                        data-playlist-id="{{ $playlist->id }}"
                                        data-liked="{{ $isLiked ? 'true' : 'false' }}"
                                        class="like-btn w-12 h-12 rounded-full flex items-center justify-center {{ $isLiked ? 'liked' : '' }}"
                                        title="{{ $isLiked ? 'Remove from favorites' : 'Add to favorites' }}">
                                    <div class="flex items-center gap-2 like-icon-wrapper">
                                        <svg class="w-6 h-6 transition-all duration-300 like-icon"
                                             fill="{{ $isLiked ? 'currentColor' : 'none' }}"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                </button>
                            @endauth

                            <!-- Share Button -->
                            <button class="p-3 rounded-full action-btn"
                                    onclick="sharePlaylist()"
                                    title="Share playlist">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>

                            <!-- More Options Button -->
                            <button class="p-3 rounded-full action-btn"
                                    onclick="showMoreOptions()"
                                    title="More options">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Songs List -->
        <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if ($playlist->songs->isEmpty())
                <div class="py-16 text-center">
                    <div class="mb-4 text-6xl">🎵</div>
                    <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No songs in this playlist</h3>
                    <p style="color: var(--text-secondary);">Add some songs to get started!</p>
                </div>
            @else
                <div class="space-y-2">
                    <div class="flex items-center px-6 py-3 text-sm font-medium" style="color: var(--text-secondary);">
                        <div class="w-8">#</div>
                        <div class="flex-1 ml-4">TITLE</div>
                        <div class="hidden w-48 md:block">ALBUM</div>
                        <div class="hidden w-32 lg:block">DATE ADDED</div>
                        <div class="w-20 text-right">
                            <svg class="w-4 h-4 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                    </div>

                    @foreach ($playlist->songs as $index => $song)
                        <div class="flex items-center px-6 py-4 rounded-lg cursor-pointer song-row group"
                             onclick="playSongFromPlaylist({{ $index }})">

                            <!-- Song Number / Play Button -->
                            <div class="w-8 text-center">
                                <span class="song-number group-hover:hidden">{{ $index + 1 }}</span>
                                <svg class="hidden w-4 h-4 mx-auto group-hover:block" style="color: var(--accent-color);" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>

                            <!-- Song Info -->
                            <div class="flex items-center flex-1 min-w-0 ml-4">
                                <div class="flex-shrink-0 w-12 h-12 mr-4 overflow-hidden rounded">
                                    @if($song->album->cover_image)
                                        <img src="{{ asset('storage/' . $song->album->cover_image) }}"
                                             alt="{{ $song->album->title }}"
                                             class="object-cover w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-600 to-gray-800">
                                            <span class="text-xs text-white">🎵</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="font-medium truncate" style="color: var(--text-primary);">{{ $song->title }}</p>
                                    <p class="text-sm truncate" style="color: var(--text-secondary);">{{ $song->album->user->name }}</p>
                                </div>
                            </div>

                            <!-- Album -->
                            <div class="hidden w-48 md:block">
                                <p class="text-sm truncate" style="color: var(--text-secondary);">{{ $song->album->title }}</p>
                            </div>

                            <!-- Date Added -->
                            <div class="hidden w-32 lg:block">
                                <p class="text-sm" style="color: var(--text-secondary);">{{ $song->created_at->format('M d, Y') }}</p>
                            </div>

                            <!-- Duration -->
                            <div class="w-20 text-right">
                                <span class="px-2 py-1 text-sm rounded-full duration-badge">
                                    {{ $song->duration ?? '3:45' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        // Create playlist data for the audio player
        const playlistSongs = [
            @foreach ($playlist->songs as $song)
                {
                    title: '{{ $song->title }}',
                    artist: '{{ $song->album->user->name }}',
                    cover: '{{ $song->album->cover_image ? asset('storage/' . $song->album->cover_image) : asset('images/default-album.png') }}',
                    audioPath: '{{ asset('storage/' . $song->path) }}'
                },
            @endforeach
        ];

        function playPlaylist() {
            if (playlistSongs.length > 0) {
                const firstSong = playlistSongs[0];
                playSong(firstSong.title, firstSong.artist, firstSong.cover, firstSong.audioPath, playlistSongs);
            }
        }

        function playSongFromPlaylist(index) {
            if (playlistSongs[index]) {
                const song = playlistSongs[index];
                playSong(song.title, song.artist, song.cover, song.audioPath, playlistSongs);
            }
        }

        // Like functionality
        async function togglePlaylistLike(playlistId, buttonElement) {
            try {
                const response = await fetch(`/playlists/${playlistId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    updateLikeButton(buttonElement, data.liked, data.likes_count);
                    showToast(data.message, data.liked ? 'success' : 'info');

                    // Update the likes count in the playlist info
                    updatePlaylistStats(data.likes_count);
                } else {
                    showToast(data.message, 'error');
                }
            } catch (error) {
                console.error('Error toggling like:', error);
                showToast('Something went wrong. Please try again.', 'error');
            }
        }

        function updateLikeButton(buttonElement, isLiked, likesCount) {
            const icon = buttonElement.querySelector('.like-icon');

            // Update button state
            buttonElement.dataset.liked = isLiked;
            buttonElement.title = isLiked ? 'Remove from favorites' : 'Add to favorites';

            // Update visual state
            if (isLiked) {
                buttonElement.classList.add('liked');
                icon.setAttribute('fill', 'currentColor');
            } else {
                buttonElement.classList.remove('liked');
                icon.setAttribute('fill', 'none');
            }

            // Animate the button
            buttonElement.style.transform = 'scale(1.2)';
            setTimeout(() => {
                buttonElement.style.transform = '';
            }, 150);
        }

        function updatePlaylistStats(likesCount) {
            // Find and update the likes count in the playlist info section
            const statsSection = document.querySelector('.flex.items-center.gap-6');
            if (statsSection) {
                const likesSpan = statsSection.children[4]; // Assuming it's the 5th element
                if (likesSpan) {
                    likesSpan.textContent = `${likesCount} likes`;
                }
            }
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transition-all duration-300 transform translate-x-full`;

            const bgColor = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            }[type] || 'bg-gray-500';

            toast.classList.add(bgColor);
            toast.innerHTML = `
                <div class="flex items-center gap-3 text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        ${type === 'success' ?
                            '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>' :
                            '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>'
                        }
                    </svg>
                    <span class="font-medium">${message}</span>
                </div>
            `;

            document.body.appendChild(toast);

            // Animate in
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);

            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Share functionality
        function sharePlaylist() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $playlist->name }}',
                    text: 'Check out this playlist: {{ $playlist->name }}',
                    url: window.location.href
                });
            } else {
                // Fallback: Copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showToast('Playlist link copied to clipboard!', 'success');
                });
            }
        }

        // More options functionality
        function showMoreOptions() {
            showToast('More options coming soon!', 'info');
        }
    </script>
</x-app-layout>
