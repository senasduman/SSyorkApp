<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Playlist') }}
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

        .form-section {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .form-section:hover {
            border-color: var(--accent-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .input-field {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: var(--secondary-bg);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .input-field::placeholder {
            color: var(--text-secondary);
        }

        .label {
            color: var(--text-primary);
            font-weight: 500;
        }

        .primary-btn {
            background: linear-gradient(135deg, var(--accent-color) 0%, #5A9FE5 100%);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(74, 144, 226, 0.4);
        }

        .secondary-btn {
            background: rgba(34, 197, 94, 0.9);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .secondary-btn:hover {
            background: rgba(34, 197, 94, 1);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.4);
        }

        .danger-btn {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .danger-btn:hover {
            background: rgba(239, 68, 68, 1);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4);
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            background: var(--hover-bg);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--accent-color);
            background: var(--secondary-bg);
        }

        .preview-image {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .preview-image:hover {
            border-color: var(--accent-color);
            transform: scale(1.05);
        }

        .icon-wrapper {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .icon-wrapper:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        .song-item {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .song-item:hover {
            border-color: var(--accent-color);
            background: var(--secondary-bg);
            transform: translateX(5px);
        }

        .privacy-toggle {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            padding: 16px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .privacy-toggle:hover {
            background: var(--secondary-bg);
            border-color: var(--accent-color);
        }

        .privacy-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .privacy-option:hover {
            background: var(--accent-color);
            color: white;
        }

        .privacy-option.selected {
            background: var(--accent-color);
            color: white;
        }

        .empty-state {
            background: var(--hover-bg);
            border: 2px dashed var(--border-color);
        }

        .album-selector {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .album-selector:focus {
            background: var(--secondary-bg);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .song-checkbox {
            accent-color: var(--accent-color);
        }

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }
    </style>

    <div class="py-12 page-container">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 overflow-hidden shadow-xl content-card rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="flex items-center text-3xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-4xl">🎵</span>
                                {{ __('Edit Playlist') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Update your playlist details and manage songs
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm" style="color: var(--text-secondary);">Playlist</div>
                            <div class="font-mono text-lg" style="color: var(--accent-color);">{{ $playlist->name }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="p-4 mb-8 rounded-xl success-message">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Playlist Details Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Playlist Information</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Update your playlist details</p>
                        </div>
                    </div>

                    <form action="{{ route('playlists.update', $playlist) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            <!-- Left Column - Form Fields -->
                            <div class="space-y-6">
                                <!-- Playlist Name -->
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium label">
                                        Playlist Name *
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ $playlist->name }}"
                                           class="block w-full px-4 py-3 input-field rounded-xl"
                                           placeholder="Enter playlist name..."
                                           required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block mb-2 text-sm font-medium label">
                                        Description
                                    </label>
                                    <textarea name="description"
                                              id="description"
                                              rows="4"
                                              class="block w-full px-4 py-3 resize-none input-field rounded-xl"
                                              placeholder="Describe your playlist...">{{ $playlist->description }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Privacy Settings -->
                                <div>
                                    <label class="block mb-3 text-sm font-medium label">
                                        Privacy Settings
                                    </label>
                                    <div class="privacy-toggle">
                                        <div class="space-y-2">
                                            <div class="privacy-option {{ $playlist->is_public ? 'selected' : '' }}" onclick="selectPrivacy('public')">
                                                <input type="radio"
                                                       name="is_public"
                                                       value="1"
                                                       id="public"
                                                       class="hidden"
                                                       {{ $playlist->is_public ? 'checked' : '' }}>
                                                <div class="flex items-center justify-center w-5 h-5 border-2 border-current rounded-full">
                                                    <div class="w-2 h-2 transition-opacity bg-current rounded-full" id="public-dot" style="opacity: {{ $playlist->is_public ? '1' : '0' }};"></div>
                                                </div>
                                                <div>
                                                    <div class="font-medium">🌍 Public</div>
                                                    <div class="text-xs opacity-75">Anyone can find and listen to this playlist</div>
                                                </div>
                                            </div>
                                            <div class="privacy-option {{ !$playlist->is_public ? 'selected' : '' }}" onclick="selectPrivacy('private')">
                                                <input type="radio"
                                                       name="is_public"
                                                       value="0"
                                                       id="private"
                                                       class="hidden"
                                                       {{ !$playlist->is_public ? 'checked' : '' }}>
                                                <div class="flex items-center justify-center w-5 h-5 border-2 border-current rounded-full">
                                                    <div class="w-2 h-2 transition-opacity bg-current rounded-full" id="private-dot" style="opacity: {{ !$playlist->is_public ? '1' : '0' }};"></div>
                                                </div>
                                                <div>
                                                    <div class="font-medium">🔒 Private</div>
                                                    <div class="text-xs opacity-75">Only you can access this playlist</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Cover Upload -->
                            <div>
                                <label class="block mb-3 text-sm font-medium label">
                                    Current Cover
                                </label>

                                @if ($playlist->cover_image)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $playlist->cover_image) }}"
                                             alt="Current Cover"
                                             id="current_cover"
                                             class="object-cover w-full h-64 preview-image">
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-full h-64 mb-4 bg-gradient-to-br from-gray-600 to-gray-800 rounded-xl">
                                        <div class="text-center">
                                            <div class="mb-2 text-6xl text-white opacity-80">🎵</div>
                                            <p class="text-white opacity-60">No cover image</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="p-6 text-center file-upload-area rounded-xl"
                                     onclick="document.getElementById('cover_image').click()">
                                    <input type="file"
                                           name="cover_image"
                                           id="cover_image"
                                           class="hidden"
                                           accept="image/*"
                                           onchange="previewImage(event)">
                                    <div class="mb-2 text-4xl">🖼️</div>
                                    <p class="text-sm" style="color: var(--text-primary);">
                                        Click to change cover image
                                    </p>
                                    <p class="mt-1 text-xs" style="color: var(--text-secondary);">
                                        JPG, PNG, GIF up to 10MB
                                    </p>
                                </div>

                                @error('cover_image')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                    class="flex items-center gap-2 px-8 py-3 font-semibold primary-btn rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                {{ __('Update Playlist') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Songs from Album Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Add Songs from Album</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Select songs from existing albums to add to your playlist</p>
                        </div>
                    </div>

                    <form action="{{ route('playlists.addAlbumSongs', $playlist) }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Album Selector -->
                        <div>
                            <label for="album_id_selector" class="block mb-2 text-sm font-medium label">
                                Select Album
                            </label>
                            <select id="album_id_selector"
                                    class="block w-full px-4 py-3 album-selector rounded-xl">
                                <option value="">-- {{ __('Select an Album') }} --</option>
                                @foreach ($allAlbums as $album)
                                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Songs List -->
                        <div id="songs_from_album_container" class="hidden">
                            <label class="block mb-3 text-sm font-medium label">
                                Select Songs to Add
                            </label>
                            <div id="songs_list_for_playlist"
                                 class="p-4 overflow-y-auto rounded-xl max-h-60"
                                 style="background: var(--hover-bg); border: 1px solid var(--border-color);">
                                <p style="color: var(--text-secondary);">{{ __('Select an album to see its songs.') }}</p>
                            </div>
                        </div>

                        <!-- Add Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    id="add_selected_songs_button"
                                    class="items-center hidden gap-2 px-6 py-3 font-semibold secondary-btn rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Add Selected Songs') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Songs Section -->
            <div class="overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                                <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold" style="color: var(--text-primary);">Songs in {{ $playlist->name }}</h3>
                                <p class="text-sm" style="color: var(--text-secondary);">Manage your playlist tracks</p>
                            </div>
                        </div>
                        <div class="px-3 py-1 text-sm rounded-full" style="background: var(--hover-bg); color: var(--text-secondary);">
                            {{ $playlist->songs->count() }} tracks
                        </div>
                    </div>

                    @if ($playlist->songs->isEmpty())
                        <div class="py-12 text-center empty-state rounded-2xl">
                            <div class="mb-4 text-6xl">🎵</div>
                            <h4 class="mb-2 text-lg font-semibold" style="color: var(--text-primary);">
                                No songs in this playlist yet
                            </h4>
                            <p class="text-sm" style="color: var(--text-secondary);">
                                Add your first song using the album selector above
                            </p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($playlist->songs as $index => $song)
                                <div class="flex items-center justify-between p-4 song-item rounded-2xl">
                                    <div class="flex items-center gap-4">
                                        <!-- Track Number -->
                                        <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background: var(--accent-color); color: white;">
                                            <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                        </div>

                                        <!-- Song Info -->
                                        <div>
                                            <h4 class="font-semibold" style="color: var(--text-primary);">
                                                {{ $song->title }}
                                            </h4>
                                            <p class="text-sm" style="color: var(--text-secondary);">
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                    </svg>
                                                    {{ $song->album->title ?? 'Unknown Album' }}
                                                </span>
                                                <span class="mx-2">•</span>
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                    </svg>
                                                    {{ $song->album->user->name ?? 'Unknown Artist' }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <form action="{{ route('playlists.removeSong', [$playlist->id, $song->id]) }}"
                                          method="POST"
                                          onsubmit="return confirm('{{ __('Are you sure you want to remove this song?') }}')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center gap-1 px-4 py-2 rounded-lg danger-btn">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            <span class="text-sm">Remove</span>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('current_cover').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function selectPrivacy(type) {
            // Remove selected class from all options
            document.querySelectorAll('.privacy-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Hide all dots
            document.getElementById('public-dot').style.opacity = '0';
            document.getElementById('private-dot').style.opacity = '0';

            // Select the clicked option
            event.currentTarget.classList.add('selected');

            if (type === 'public') {
                document.getElementById('public').checked = true;
                document.getElementById('public-dot').style.opacity = '1';
            } else {
                document.getElementById('private').checked = true;
                document.getElementById('private-dot').style.opacity = '1';
            }
        }

        // Album songs selector functionality
        document.addEventListener('DOMContentLoaded', function () {
            const albumSelector = document.getElementById('album_id_selector');
            const songsContainer = document.getElementById('songs_from_album_container');
            const songsListDiv = document.getElementById('songs_list_for_playlist');
            const addSongsButton = document.getElementById('add_selected_songs_button');

            // Prepare album data
            const albumsData = @json($allAlbums->mapWithKeys(function ($album) {
                return [$album->id => [
                    'title' => $album->title,
                    'songs' => $album->songs->map(function ($song) {
                        return ['id' => $song->id, 'title' => $song->title];
                    })
                ]];
            }));

            albumSelector.addEventListener('change', function () {
                const selectedAlbumId = this.value;
                songsListDiv.innerHTML = '';

                if (selectedAlbumId && albumsData[selectedAlbumId]) {
                    const album = albumsData[selectedAlbumId];
                    if (album.songs.length > 0) {
                        const ul = document.createElement('ul');
                        ul.className = 'space-y-2';
                        album.songs.forEach(song => {
                            const li = document.createElement('li');
                            li.className = 'flex items-center gap-3 p-2 rounded-lg hover:bg-opacity-50';
                            li.style.background = 'var(--secondary-bg)';

                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.name = 'song_ids[]';
                            checkbox.value = song.id;
                            checkbox.id = `playlist_song_add_${song.id}`;
                            checkbox.className = 'song-checkbox w-4 h-4 rounded';

                            const label = document.createElement('label');
                            label.htmlFor = checkbox.id;
                            label.textContent = song.title;
                            label.className = 'text-sm font-medium cursor-pointer';
                            label.style.color = 'var(--text-primary)';

                            li.appendChild(checkbox);
                            li.appendChild(label);
                            ul.appendChild(li);
                        });
                        songsListDiv.appendChild(ul);
                        addSongsButton.classList.remove('hidden');
                        addSongsButton.classList.add('flex');
                    } else {
                        songsListDiv.innerHTML = `<p style="color: var(--text-secondary);">{{ __('This album has no songs.') }}</p>`;
                        addSongsButton.classList.add('hidden');
                    }
                    songsContainer.classList.remove('hidden');
                } else {
                    songsListDiv.innerHTML = `<p style="color: var(--text-secondary);">{{ __('Select an album to see its songs.') }}</p>`;
                    songsContainer.classList.add('hidden');
                    addSongsButton.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
