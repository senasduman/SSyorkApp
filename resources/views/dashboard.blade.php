<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-2">
                <div class="flex items-center px-3 py-1 text-sm text-white bg-green-500 rounded-full">
                    <div class="w-2 h-2 mr-2 bg-white rounded-full animate-pulse"></div>
                    Online
                </div>
            </div>
        </div>
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

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        .stats-card {
            background: var(--secondary-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
        }
        .album-card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }
        .album-card:hover {
            background: var(--hover-bg);
            border-color: var(--accent-color);
        }
        .play-button {
            background: var(--accent-color);
        }
        .play-button:hover {
            background: #5A9FE5;
        }
        .music-wave {
            animation: wave 1.5s ease-in-out infinite;
        }
        .music-wave:nth-child(2) { animation-delay: 0.1s; }
        .music-wave:nth-child(3) { animation-delay: 0.2s; }
        .music-wave:nth-child(4) { animation-delay: 0.3s; }

        @keyframes wave {
            0%, 100% { height: 10px; }
            50% { height: 25px; }
        }

        .quick-action-btn {
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }
        .quick-action-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .content-section {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }

        .artist-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .artist-link:hover {
            color: var(--accent-color) !important;
            text-decoration: underline;
        }

        .artist-badge {
            transition: all 0.3s ease;
        }

        .artist-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-link {
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 4px 8px;
            margin: -4px -8px;
        }

        .profile-link:hover {
            background: var(--hover-bg);
            transform: translateX(2px);
        }
    </style>

    <!-- Welcome Section -->
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl gradient-bg rounded-3xl">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="mb-2 text-3xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p class="text-lg opacity-90">Ready to discover your next favorite song?</p>
                        </div>
                        <div class="flex space-x-1">
                            <div class="w-1 bg-white rounded-full music-wave"></div>
                            <div class="w-1 bg-white rounded-full music-wave"></div>
                            <div class="w-1 bg-white rounded-full music-wave"></div>
                            <div class="w-1 bg-white rounded-full music-wave"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Total Albums -->
                <div class="p-6 text-center stats-card rounded-2xl card-hover">
                    <div class="mb-3 text-4xl">🎼</div>
                    <h3 class="text-2xl font-bold" style="color: var(--text-primary);">{{ $albums->count() }}</h3>
                    <p style="color: var(--text-secondary);">Total Albums</p>
                </div>

                <!-- Recently Added -->
                <div class="p-6 text-center stats-card rounded-2xl card-hover">
                    <div class="mb-3 text-4xl">🆕</div>
                    <h3 class="text-2xl font-bold" style="color: var(--text-primary);">{{ $albums->where('created_at', '>=', now()->subWeek())->count() }}</h3>
                    <p style="color: var(--text-secondary);">This Week</p>
                </div>

                <!-- Your Music -->
                <div class="p-6 text-center stats-card rounded-2xl card-hover">
                    <div class="mb-3 text-4xl">🎧</div>
                    <h3 class="text-2xl font-bold" style="color: var(--text-primary);">∞</h3>
                    <p style="color: var(--text-secondary);">Hours of Music</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Albums Grid Section -->
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl content-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="flex items-center text-2xl font-bold" style="color: var(--text-primary);">
                            <span class="mr-3 text-3xl">🎵</span>
                            {{ __('Available Albums') }}
                        </h3>
                        <div class="flex items-center space-x-2 text-sm" style="color: var(--text-secondary);">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $albums->count() }} albums</span>
                        </div>
                    </div>

                    @if($albums->count() > 0)
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($albums as $album)
                                <div class="p-6 shadow-lg album-card rounded-2xl card-hover">
                                    <!-- Album Header with Cover -->
                                    <div class="flex items-start gap-4 mb-4">
                                        <!-- Album Cover -->
                                        <div class="flex-shrink-0">
                                            <div class="w-16 h-16 overflow-hidden rounded-lg">
                                                @if($album->cover_image)
                                                    <img src="{{ asset('storage/' . $album->cover_image) }}"
                                                         alt="{{ $album->title }}"
                                                         class="object-cover w-full h-full">
                                                @else
                                                    <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-600 to-gray-800">
                                                        <span class="text-lg text-white">🎼</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Album Info -->
                                        <div class="flex-1 min-w-0">
                                            <h4 class="mb-1 text-lg font-bold truncate" style="color: var(--text-primary);">
                                                <a href="{{ route('albums.show', $album->id) }}" class="hover:underline">
                                                    {{ $album->title }}
                                                </a>
                                            </h4>

                                            <!-- Artist Info with Profile Link -->
                                            <div class="mb-2 artist-info">
                                                <a href="{{ route('users.profile', $album->user) }}"
                                                   class="flex items-center gap-1 text-sm artist-link profile-link"
                                                   style="color: var(--text-secondary);">
                                                    <span>By {{ $album->user->name ?? 'Unknown Artist' }}</span>

                                                    @if($album->user && $album->user->is_artist)
                                                        <span class="artist-badge inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-white rounded-full"
                                                              style="background: var(--accent-color);">
                                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                            </svg>
                                                        </span>
                                                    @endif
                                                </a>
                                            </div>

                                            <!-- Album Metadata -->
                                            <div class="mb-2 text-xs" style="color: var(--text-secondary);">
                                                <span>{{ $album->created_at->format('M d, Y') }}</span>
                                                @if($album->songs && $album->songs->count() > 0)
                                                    <span class="mx-1">•</span>
                                                    <span>{{ $album->songs->count() }} songs</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Album Description -->
                                    @if($album->description)
                                        <p class="mb-4 text-sm line-clamp-2" style="color: var(--text-secondary);">
                                            {{ Str::limit($album->description, 100) }}
                                        </p>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <!-- Follow Button (if not own album) -->
                                            @if($album->user && Auth::id() !== $album->user->id)
                                                <x-follow-button :user="$album->user" />
                                            @endif
                                        </div>

                                        <div class="flex space-x-2">
                                            <!-- View Album Button -->
                                            <a href="{{ route('albums.show', $album->id) }}"
                                               class="px-4 py-2 text-sm font-medium transition-colors rounded-lg"
                                               style="background: var(--hover-bg); color: var(--text-primary);"
                                               onmouseover="this.style.background='var(--accent-color)'"
                                               onmouseout="this.style.background='var(--hover-bg)'">
                                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>

                                            <!-- Play Button (if has songs) -->
                                            @if($album->songs && $album->songs->count() > 0)
                                                <button onclick="playAlbum('{{ $album->title }}', '{{ $album->user->name ?? 'Unknown' }}', '{{ $album->cover_image ? asset('storage/' . $album->cover_image) : asset('images/default-album.png') }}', '{{ $album->songs->first() ? asset('storage/' . $album->songs->first()->path) : '' }}')"
                                                        class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg play-button"
                                                        onmouseover="this.style.background='#5A9FE5'"
                                                        onmouseout="this.style.background='var(--accent-color)'">
                                                    <svg class="inline w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z"/>
                                                    </svg>
                                                    Play
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <div class="mb-4 text-6xl">🎵</div>
                            <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No albums yet</h3>
                            <p class="mb-6" style="color: var(--text-secondary);">Start building your music library today!</p>
                            @if (Auth::user()->is_artist)
                                <a href="{{ route('albums.create') }}"
                                   class="inline-block px-6 py-3 font-semibold text-white transition-transform rounded-full hover:scale-105"
                                   style="background: var(--accent-color);">
                                    Add Your First Album
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="py-6 pb-24">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl content-section rounded-3xl">
                <div class="p-8">
                    <h3 class="flex items-center mb-6 text-2xl font-bold" style="color: var(--text-primary);">
                        <span class="mr-3 text-3xl">⚡</span>
                        {{ __('Quick Actions') }}
                    </h3>
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                        <!-- Upload Song/Album - Only for Artists -->
                        @if (Auth::user()->is_artist)
                            <a href="{{ route('albums.create') }}" class="p-4 text-white transition-transform bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl quick-action-btn">
                                <div class="mb-2 text-2xl">🎤</div>
                                <div class="text-sm font-medium">Upload Album</div>
                            </a>
                        @else
                            <div class="p-4 transition-transform opacity-50 rounded-2xl" style="background: var(--hover-bg); color: var(--text-secondary);">
                                <div class="mb-2 text-2xl">🎤</div>
                                <div class="text-sm font-medium">Artist Only</div>
                            </div>
                        @endif

                        <!-- Create Playlist -->
                        <a href="{{ route('playlists.create') }}" class="p-4 text-white transition-transform bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl quick-action-btn">
                            <div class="mb-2 text-2xl">📱</div>
                            <div class="text-sm font-medium">Create Playlist</div>
                        </a>

                        <!-- View Profile -->
                        <a href="{{ route('profile.show') }}" class="p-4 text-white transition-transform bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl quick-action-btn">
                            <div class="mb-2 text-2xl">👤</div>
                            <div class="text-sm font-medium">View Profile</div>
                        </a>

                        <!-- Settings -->
                        <a href="{{ route('profile.edit') }}" class="p-4 text-white transition-transform bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl quick-action-btn">
                            <div class="mb-2 text-2xl">⚙️</div>
                            <div class="text-sm font-medium">Settings</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function playAlbum(title, artist, cover, audioPath) {
            // This function will be called when the play button is clicked
            if (typeof playSong === 'function') {
                playSong(title, artist, cover, audioPath);
            } else {
                console.log('Audio player not ready');
            }
        }
    </script>
</x-app-layout>
