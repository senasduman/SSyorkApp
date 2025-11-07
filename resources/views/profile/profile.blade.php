<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
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

        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .profile-card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }

        .content-card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }

        .album-item {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .album-item:hover {
            background: var(--accent-color);
            transform: scale(1.02);
        }

        .tab-button {
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .tab-button.active {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .tab-button:not(.active) {
            background: var(--hover-bg);
            color: var(--text-secondary);
        }

        .tab-button:not(.active):hover {
            background: var(--accent-color);
            color: white;
        }

        .user-item {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .user-item:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        .section-hidden {
            display: none;
        }

        .liked-playlist-item {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .liked-playlist-item:hover {
            background: var(--accent-color);
            transform: scale(1.02);
            border-color: var(--accent-color);
        }

        .liked-heart {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            padding: 4px;
            border-radius: 50%;
            font-size: 12px;
        }
    </style>

    <div class="py-12" style="background: var(--primary-bg); min-height: 100vh;">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="mb-8 overflow-hidden shadow-xl profile-card rounded-3xl">
                <div class="p-8">
                    <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">
                        <!-- Profile Photo -->
                        <div class="flex-shrink-0">
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default-profile.png') }}"
                                 alt="Profile Photo"
                                 class="object-cover w-32 h-32 rounded-full shadow-lg">
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-1">
                            <h1 class="mb-2 text-3xl font-bold" style="color: var(--text-primary);">
                                {{ Auth::user()->name }}
                            </h1>

                            @if(Auth::user()->is_artist)
                                <span class="inline-flex items-center px-3 py-1 mb-3 text-sm font-medium text-white rounded-full"
                                      style="background: var(--accent-color);">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    Artist
                                </span>
                            @endif

                            <p class="mb-4 text-lg" style="color: var(--text-secondary);">
                                {{ Auth::user()->bio ?? 'No description available.' }}
                            </p>

                            <!-- Followers/Following Stats -->
                            <div class="flex items-center gap-6 mb-4">
                                <button onclick="showSection('followers')" class="text-center transition-colors cursor-pointer hover:underline">
                                    <div class="text-2xl font-bold" style="color: var(--text-primary);">
                                        {{ Auth::user()->followers_count }}
                                    </div>
                                    <div class="text-sm" style="color: var(--text-secondary);">
                                        Followers
                                    </div>
                                </button>

                                <button onclick="showSection('following')" class="text-center transition-colors cursor-pointer hover:underline">
                                    <div class="text-2xl font-bold" style="color: var(--text-primary);">
                                        {{ Auth::user()->following_count }}
                                    </div>
                                    <div class="text-sm" style="color: var(--text-secondary);">
                                        Following
                                    </div>
                                </button>

                                <button onclick="showSection('playlists')" class="text-center transition-colors cursor-pointer hover:underline">
                                    <div class="text-2xl font-bold" style="color: var(--text-primary);">
                                        {{ $playlists->count() }}
                                    </div>
                                    <div class="text-sm" style="color: var(--text-secondary);">
                                        Playlists
                                    </div>
                                </button>

                                <button onclick="showSection('liked-playlists')" class="text-center transition-colors cursor-pointer hover:underline">
                                    <div class="text-2xl font-bold" style="color: var(--text-primary);">
                                        {{ Auth::user()->likedPlaylists->count() }}
                                    </div>
                                    <div class="text-sm" style="color: var(--text-secondary);">
                                        Liked
                                    </div>
                                </button>

                                @if(Auth::user()->is_artist)
                                    <button onclick="showSection('albums')" class="text-center transition-colors cursor-pointer hover:underline">
                                        <div class="text-2xl font-bold" style="color: var(--text-primary);">
                                            {{ $albums->count() }}
                                        </div>
                                        <div class="text-sm" style="color: var(--text-secondary);">
                                            Albums
                                        </div>
                                    </button>
                                @endif
                            </div>

                            <!-- Edit Profile Button -->
                            <a href="{{ route('profile.edit') }}"
                               class="inline-flex items-center px-6 py-3 font-semibold text-white transition-colors rounded-lg hover:bg-blue-600"
                               style="background: var(--accent-color);">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Navigation Tabs -->
            <div class="mb-8 overflow-hidden shadow-xl content-card rounded-3xl">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button onclick="showSection('playlists')" id="tab-playlists" class="px-4 py-2 text-sm font-medium rounded-lg tab-button active">
                            🎵 Playlists
                        </button>
                        <button onclick="showSection('liked-playlists')" id="tab-liked-playlists" class="px-4 py-2 text-sm font-medium rounded-lg tab-button">
                            ❤️ Liked ({{ Auth::user()->likedPlaylists->count() }})
                        </button>
                        @if(Auth::user()->is_artist)
                            <button onclick="showSection('albums')" id="tab-albums" class="px-4 py-2 text-sm font-medium rounded-lg tab-button">
                                🎼 Albums
                            </button>
                        @endif
                        <button onclick="showSection('followers')" id="tab-followers" class="px-4 py-2 text-sm font-medium rounded-lg tab-button">
                            👥 Followers ({{ Auth::user()->followers_count }})
                        </button>
                        <button onclick="showSection('following')" id="tab-following" class="px-4 py-2 text-sm font-medium rounded-lg tab-button">
                            ➡️ Following ({{ Auth::user()->following_count }})
                        </button>
                    </div>

                    <!-- Playlists Section -->
                    <div id="section-playlists">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="flex items-center text-2xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-3xl">🎵</span>
                                Your Playlists
                            </h2>
                            <a href="{{ route('playlists.create') }}"
                               class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg hover:bg-green-600"
                               style="background: #10b981;">
                                Create Playlist
                            </a>
                        </div>

                        @if($playlists->count() > 0)
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                @foreach ($playlists as $playlist)
                                    <div class="p-4 album-item rounded-2xl card-hover">
                                        <a href="{{ route('playlists.show', $playlist->id) }}" class="block">
                                            <div class="w-full h-40 mb-3 overflow-hidden rounded-lg shadow-md">
                                                @if($playlist->cover_image)
                                                    <img src="{{ asset('storage/' . $playlist->cover_image) }}"
                                                         alt="{{ $playlist->name }}"
                                                         class="object-cover w-full h-full">
                                                @else
                                                    <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-purple-500 to-blue-600">
                                                        <div class="text-3xl text-white">🎵</div>
                                                    </div>
                                                @endif
                                            </div>
                                            <h3 class="mb-1 font-semibold truncate" style="color: var(--text-primary);">
                                                {{ $playlist->name }}
                                            </h3>
                                            <p class="text-sm" style="color: var(--text-secondary);">
                                                {{ $playlist->songs->count() }} songs
                                            </p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-16 text-center">
                                <div class="mb-4 text-6xl">🎵</div>
                                <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No playlists yet</h3>
                                <p class="mb-6" style="color: var(--text-secondary);">Create your first playlist to organize your music!</p>
                                <a href="{{ route('playlists.create') }}"
                                   class="inline-block px-6 py-3 font-semibold text-white transition-transform rounded-full hover:scale-105"
                                   style="background: var(--accent-color);">
                                    Create Your First Playlist
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Liked Playlists Section -->
                    <div id="section-liked-playlists" class="section-hidden">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="flex items-center text-2xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-3xl">❤️</span>
                                Your Liked Playlists
                            </h2>
                            <a href="{{ route('playlists.liked') }}"
                               class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg hover:bg-pink-600"
                               style="background: #ec4899;">
                                View All Liked
                            </a>
                        </div>

                        @if(Auth::user()->likedPlaylists->count() > 0)
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                @foreach (Auth::user()->likedPlaylists->take(8) as $playlist)
                                    <div class="p-4 liked-playlist-item rounded-2xl card-hover">
                                        <a href="{{ route('playlists.show', $playlist->id) }}" class="block">
                                            <!-- Heart indicator -->
                                            <div class="liked-heart">
                                                ❤️
                                            </div>

                                            <div class="w-full h-40 mb-3 overflow-hidden rounded-lg shadow-md">
                                                @if($playlist->cover_image)
                                                    <img src="{{ asset('storage/' . $playlist->cover_image) }}"
                                                         alt="{{ $playlist->name }}"
                                                         class="object-cover w-full h-full">
                                                @else
                                                    <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-purple-500 to-blue-600">
                                                        <div class="text-3xl text-white">🎵</div>
                                                    </div>
                                                @endif
                                            </div>

                                            <h3 class="mb-1 font-semibold truncate" style="color: var(--text-primary);">
                                                {{ $playlist->name }}
                                            </h3>

                                            <p class="mb-1 text-sm" style="color: var(--text-secondary);">
                                                by {{ $playlist->user->name }}
                                            </p>

                                            <div class="flex items-center justify-between text-xs" style="color: var(--text-secondary);">
                                                <span>{{ $playlist->songs->count() }} songs</span>
                                                <span>{{ $playlist->likes()->count() }} likes</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            @if(Auth::user()->likedPlaylists->count() > 8)
                                <div class="mt-6 text-center">
                                    <a href="{{ route('playlists.liked') }}"
                                       class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all duration-300 rounded-xl"
                                       style="background: var(--accent-color);">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        View All {{ Auth::user()->likedPlaylists->count() }} Liked Playlists
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="py-16 text-center">
                                <div class="mb-4 text-6xl">💔</div>
                                <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No liked playlists yet</h3>
                                <p class="mb-6" style="color: var(--text-secondary);">Start exploring and like playlists to see them here!</p>
                                <a href="{{ route('playlists.index') }}"
                                   class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-transform rounded-full hover:scale-105"
                                   style="background: var(--accent-color);">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Browse Playlists
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Albums Section (Only for Artists) -->
                    @if(Auth::user()->is_artist)
                        <div id="section-albums" class="section-hidden">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="flex items-center text-2xl font-bold" style="color: var(--text-primary);">
                                    <span class="mr-3 text-3xl">🎼</span>
                                    Your Albums
                                </h2>
                                <a href="{{ route('albums.create') }}"
                                   class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg hover:bg-purple-600"
                                   style="background: #8b5cf6;">
                                    Create Album
                                </a>
                            </div>

                            @if($albums->count() > 0)
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                    @foreach ($albums as $album)
                                        <div class="p-4 album-item rounded-2xl card-hover">
                                            <a href="{{ route('albums.show', $album->id) }}" class="block">
                                                <div class="w-full h-40 mb-3 overflow-hidden rounded-lg shadow-md">
                                                    @if($album->cover_image)
                                                        <img src="{{ asset('storage/' . $album->cover_image) }}"
                                                             alt="{{ $album->title }}"
                                                             class="object-cover w-full h-full">
                                                    @else
                                                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-600 to-gray-800">
                                                            <div class="text-3xl text-white">🎼</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <h3 class="mb-1 font-semibold truncate" style="color: var(--text-primary);">
                                                    {{ $album->title }}
                                                </h3>
                                                <p class="text-sm" style="color: var(--text-secondary);">
                                                    {{ $album->created_at->format('Y') }}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-16 text-center">
                                    <div class="mb-4 text-6xl">🎼</div>
                                    <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No albums yet</h3>
                                    <p class="mb-6" style="color: var(--text-secondary);">Upload your first album to share your music with the world!</p>
                                    <a href="{{ route('albums.create') }}"
                                       class="inline-block px-6 py-3 font-semibold text-white transition-transform rounded-full hover:scale-105"
                                       style="background: var(--accent-color);">
                                        Upload Your First Album
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Followers Section -->
                    <div id="section-followers" class="section-hidden">
                        <div class="mb-6">
                            <h2 class="flex items-center text-2xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-3xl">👥</span>
                                Followers ({{ Auth::user()->followers_count }})
                            </h2>
                        </div>

                        @if(Auth::user()->followers->count() > 0)
                            <div class="space-y-4">
                                @foreach(Auth::user()->followers as $follower)
                                    <div class="flex items-center justify-between p-4 rounded-lg user-item">
                                        <div class="flex items-center gap-4">
                                            <a href="{{ route('users.profile', $follower) }}" class="w-12 h-12 overflow-hidden rounded-full">
                                                <img src="{{ $follower->profile_photo ? asset('storage/' . $follower->profile_photo) : asset('images/default-profile.png') }}"
                                                     alt="{{ $follower->name }}"
                                                     class="object-cover w-full h-full">
                                            </a>
                                            <div>
                                                <a href="{{ route('users.profile', $follower) }}" class="font-semibold hover:underline" style="color: var(--text-primary);">
                                                    {{ $follower->name }}
                                                </a>
                                                @if($follower->bio)
                                                    <p class="text-sm" style="color: var(--text-secondary);">{{ Str::limit($follower->bio, 60) }}</p>
                                                @endif
                                                @if($follower->is_artist)
                                                    <span class="inline-flex items-center px-2 py-1 mt-1 text-xs font-medium text-white rounded-full"
                                                          style="background: var(--accent-color);">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                        </svg>
                                                        Artist
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <x-follow-button :user="$follower" />
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-16 text-center">
                                <div class="mb-4 text-6xl">👥</div>
                                <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">No followers yet</h3>
                                <p style="color: var(--text-secondary);">When people follow you, they'll appear here.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Following Section -->
                    <div id="section-following" class="section-hidden">
                        <div class="mb-6">
                            <h2 class="flex items-center text-2xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-3xl">➡️</span>
                                Following ({{ Auth::user()->following_count }})
                            </h2>
                        </div>

                        @if(Auth::user()->followings->count() > 0)
                            <div class="space-y-4">
                                @foreach(Auth::user()->followings as $followedUser)
                                    <div class="flex items-center justify-between p-4 rounded-lg user-item">
                                        <div class="flex items-center gap-4">
                                            <a href="{{ route('users.profile', $followedUser) }}" class="w-12 h-12 overflow-hidden rounded-full">
                                                <img src="{{ $followedUser->profile_photo ? asset('storage/' . $followedUser->profile_photo) : asset('images/default-profile.png') }}"
                                                     alt="{{ $followedUser->name }}"
                                                     class="object-cover w-full h-full">
                                            </a>
                                            <div>
                                                <a href="{{ route('users.profile', $followedUser) }}" class="font-semibold hover:underline" style="color: var(--text-primary);">
                                                    {{ $followedUser->name }}
                                                </a>
                                                @if($followedUser->bio)
                                                    <p class="text-sm" style="color: var(--text-secondary);">{{ Str::limit($followedUser->bio, 60) }}</p>
                                                @endif
                                                @if($followedUser->is_artist)
                                                    <span class="inline-flex items-center px-2 py-1 mt-1 text-xs font-medium text-white rounded-full"
                                                          style="background: var(--accent-color);">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                        </svg>
                                                        Artist
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <x-follow-button :user="$followedUser" />
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-16 text-center">
                                <div class="mb-4 text-6xl">➡️</div>
                                <h3 class="mb-2 text-xl font-semibold" style="color: var(--text-primary);">Not following anyone</h3>
                                <p style="color: var(--text-secondary);">Discover new artists and follow them to see their content here.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionName) {
            // Hide all sections
            const sections = ['playlists', 'albums', 'followers', 'following', 'liked-playlists'];
            sections.forEach(section => {
                const element = document.getElementById('section-' + section);
                const tab = document.getElementById('tab-' + section);

                if (element) {
                    element.classList.add('section-hidden');
                }
                if (tab) {
                    tab.classList.remove('active');
                }
            });

            // Show the selected section
            const selectedSection = document.getElementById('section-' + sectionName);
            const selectedTab = document.getElementById('tab-' + sectionName);

            if (selectedSection) {
                selectedSection.classList.remove('section-hidden');
            }
            if (selectedTab) {
                selectedTab.classList.add('active');
            }
        }

        // Initialize with playlists section visible
        document.addEventListener('DOMContentLoaded', function() {
            showSection('playlists');
        });
    </script>
</x-app-layout>
