<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $album->title }}
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

        .album-hero {
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

        .like-btn {
            transition: all 0.3s ease;
        }

        .like-btn:hover {
            transform: scale(1.1);
        }

        .liked {
            color: #ef4444 !important;
        }
    </style>

    <div class="min-h-screen" style="background: var(--primary-bg);">
        <!-- Hero Section -->
        <div class="album-hero">
            <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col items-start gap-8 lg:flex-row lg:items-end">
                    <!-- Album Cover -->
                    <div class="flex-shrink-0">
                        <div class="w-64 h-64 overflow-hidden shadow-2xl album-cover rounded-2xl">
                            @if($album->cover_image)
                                <img src="{{ asset('storage/' . $album->cover_image) }}"
                                     alt="{{ $album->title }}"
                                     class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-purple-500 to-blue-600">
                                    <div class="text-6xl text-white">🎵</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Album Info -->
                    <div class="flex-1">
                        <p class="mb-2 text-sm font-medium" style="color: var(--text-secondary);">
                            ALBUM
                        </p>
                        <h1 class="mb-4 text-4xl font-bold lg:text-6xl" style="color: var(--text-primary);">
                            {{ $album->title }}
                        </h1>

                        @if($album->description)
                            <p class="mb-4 text-lg" style="color: var(--text-secondary);">
                                {{ $album->description }}
                            </p>
                        @endif

                        <div class="flex items-center gap-6 mb-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 overflow-hidden rounded-full">
                                    <img src="{{ $album->user->profile_photo ? asset('storage/' . $album->user->profile_photo) : asset('images/default-profile.png') }}"
                                         alt="{{ $album->user->name }}"
                                         class="object-cover w-full h-full">
                                </div>
                                <span class="font-medium" style="color: var(--text-primary);">
                                    {{ $album->user->name }}
                                </span>
                            </div>
                            <span style="color: var(--text-secondary);">•</span>
                            <span style="color: var(--text-secondary);">
                                {{ $songs->count() }} songs
                            </span>
                            <span style="color: var(--text-secondary);">•</span>
                            <span style="color: var(--text-secondary);">
                                {{ $album->created_at->format('Y') }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-4">
                            @if(!$songs->isEmpty())
                                <button onclick="playAlbum()"
                                        class="flex items-center gap-3 px-8 py-3 font-semibold text-white rounded-full play-all-btn">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    Play All
                                </button>
                            @endif

                            <button class="p-3 transition-colors border-2 rounded-full hover:bg-white hover:bg-opacity-10"
                                    style="border-color: var(--border-color); color: var(--text-primary);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>

                            <button class="p-3 transition-colors border-2 rounded-full hover:bg-white hover:bg-opacity-10"
                                    style="border-color: var(--border-color); color: var(--text-primary);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Songs List -->
        <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if ($songs->isEmpty())
                <div class="py-16 text-center">
                    <div class="mb-4 text-6xl">🎵</div>
                    <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No songs in this album</h3>
                    <p style="color: var(--text-secondary);">Songs will appear here when they're added.</p>
                </div>
            @else
                <div class="space-y-2">
                    <div class="flex items-center px-6 py-3 text-sm font-medium" style="color: var(--text-secondary);">
                        <div class="w-8">#</div>
                        <div class="flex-1 ml-4">TITLE</div>
                        <div class="hidden w-32 lg:block">RELEASE DATE</div>
                        <div class="w-20 text-center">LIKE</div>
                        <div class="w-20 text-right">
                            <svg class="w-4 h-4 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                    </div>

                    @foreach ($songs as $index => $song)
                        <div class="flex items-center px-6 py-4 rounded-lg cursor-pointer song-row group"
                             onclick="playSongFromAlbum({{ $index }})">

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
                                    @if($album->cover_image)
                                        <img src="{{ asset('storage/' . $album->cover_image) }}"
                                             alt="{{ $album->title }}"
                                             class="object-cover w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-600 to-gray-800">
                                            <span class="text-xs text-white">🎵</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="font-medium truncate" style="color: var(--text-primary);">{{ $song->title }}</p>
                                    <p class="text-sm truncate" style="color: var(--text-secondary);">{{ $album->user->name }}</p>
                                </div>
                            </div>

                            <!-- Release Date -->
                            <div class="hidden w-32 lg:block">
                                <p class="text-sm" style="color: var(--text-secondary);">{{ $song->created_at->format('M d, Y') }}</p>
                            </div>

                            <!-- Like Button -->
                            <div class="w-20 text-center">
                                <form action="{{ auth()->user()->likedSongs->contains($song->id) ? route('songs.unlike', $song->id) : route('songs.like', $song->id) }}"
                                      method="POST" class="inline" onclick="event.stopPropagation();">
                                    @csrf
                                    <button type="submit" class="p-2 transition-colors rounded-full like-btn hover:bg-white hover:bg-opacity-10">
                                        @if(auth()->user()->likedSongs->contains($song->id))
                                            <svg class="w-5 h-5 liked" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" style="color: var(--text-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>

                            <!-- Duration -->
                            <div class="w-20 text-right">
                                <span class="px-2 py-1 text-sm rounded-full duration-badge">3:45</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        // Create album songs data for the audio player
        const albumSongs = [
            @foreach ($songs as $song)
                {
                    title: '{{ $song->title }}',
                    artist: '{{ $album->user->name }}',
                    cover: '{{ $album->cover_image ? asset('storage/' . $album->cover_image) : asset('images/default-album.png') }}',
                    audioPath: '{{ asset('storage/' . $song->path) }}'
                },
            @endforeach
        ];

        function playAlbum() {
            if (albumSongs.length > 0) {
                const firstSong = albumSongs[0];
                playSong(firstSong.title, firstSong.artist, firstSong.cover, firstSong.audioPath, albumSongs);
            }
        }

        function playSongFromAlbum(index) {
            if (albumSongs[index]) {
                const song = albumSongs[index];
                playSong(song.title, song.artist, song.cover, song.audioPath, albumSongs);
            }
        }
    </script>
</x-app-layout>
