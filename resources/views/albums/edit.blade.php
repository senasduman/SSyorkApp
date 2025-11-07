<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Album') }}
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

        .icon-wrapper {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .icon-wrapper:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        .empty-state {
            background: var(--hover-bg);
            border: 2px dashed var(--border-color);
        }

        .play-btn {
            background: var(--accent-color);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .play-btn:hover {
            background: #5A9FE5;
            transform: scale(1.1);
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
                                <span class="mr-3 text-4xl">🎼</span>
                                {{ __('Edit Album') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Update your album details and manage tracks
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm" style="color: var(--text-secondary);">Album ID</div>
                            <div class="font-mono text-lg" style="color: var(--accent-color);">#{{ $album->id }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Album Details Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Album Information</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Update your album details</p>
                        </div>
                    </div>

                    <form action="{{ route('albums.update', $album) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            <!-- Left Column - Form Fields -->
                            <div class="space-y-6">
                                <!-- Title Field -->
                                <div>
                                    <label for="title" class="block mb-2 text-sm font-medium label">
                                        Album Title *
                                    </label>
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           value="{{ $album->title }}"
                                           class="block w-full px-4 py-3 input-field rounded-xl"
                                           placeholder="Enter album title..."
                                           required>
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description Field -->
                                <div>
                                    <label for="description" class="block mb-2 text-sm font-medium label">
                                        Description
                                    </label>
                                    <textarea name="description"
                                              id="description"
                                              rows="4"
                                              class="block w-full px-4 py-3 resize-none input-field rounded-xl"
                                              placeholder="Tell people about your album...">{{ $album->description }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Cover Image Upload -->
                                <div>
                                    <label for="cover_image" class="block mb-2 text-sm font-medium label">
                                        Album Cover
                                    </label>
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
                                            Click to change album cover
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

                            <!-- Right Column - Current Cover -->
                            <div>
                                <div class="block mb-2 text-sm font-medium label">
                                    Current Cover
                                </div>
                                @if ($album->cover_image)
                                    <div class="w-full">
                                        <img src="{{ asset('storage/' . $album->cover_image) }}"
                                             alt="Current Album Cover"
                                             id="current_cover"
                                             class="object-cover w-full h-64 preview-image">
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-full h-64 bg-gradient-to-br from-gray-600 to-gray-800 rounded-xl">
                                        <div class="text-center">
                                            <div class="mb-2 text-6xl text-white opacity-80">🎼</div>
                                            <p class="text-white opacity-60">No cover image</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                    class="flex items-center gap-2 px-8 py-3 font-semibold primary-btn rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                {{ __('Update Album') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Song Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Add New Song</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Upload a new track to {{ $album->title }}</p>
                        </div>
                    </div>

                    <form action="{{ route('albums.addSong', $album) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Song Title -->
                            <div>
                                <label for="song_title" class="block mb-2 text-sm font-medium label">
                                    Song Title *
                                </label>
                                <input type="text"
                                       name="title"
                                       id="song_title"
                                       class="block w-full px-4 py-3 input-field rounded-xl"
                                       placeholder="Enter song title..."
                                       required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Song File -->
                            <div>
                                <label for="song_file" class="block mb-2 text-sm font-medium label">
                                    Audio File *
                                </label>
                                <div class="p-4 text-center file-upload-area rounded-xl"
                                     onclick="document.getElementById('song_file').click()">
                                    <input type="file"
                                           name="file"
                                           id="song_file"
                                           class="hidden"
                                           accept="audio/*"
                                           onchange="previewAudio(event)"
                                           required>
                                    <div id="audio-placeholder">
                                        <div class="mb-2 text-2xl">🎵</div>
                                        <p class="text-sm" style="color: var(--text-primary);">
                                            Click to upload audio
                                        </p>
                                        <p class="mt-1 text-xs" style="color: var(--text-secondary);">
                                            MP3, WAV, M4A up to 50MB
                                        </p>
                                    </div>
                                    <div id="audio-preview" class="hidden">
                                        <div class="mb-2 text-2xl">🎵</div>
                                        <p class="text-sm" style="color: var(--accent-color);" id="audio-name"></p>
                                    </div>
                                </div>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Add Song Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="flex items-center gap-2 px-6 py-3 font-semibold secondary-btn rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Add Song') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Songs Management Section -->
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
                                <h3 class="text-xl font-bold" style="color: var(--text-primary);">Album Tracks</h3>
                                <p class="text-sm" style="color: var(--text-secondary);">Manage songs in {{ $album->title }}</p>
                            </div>
                        </div>
                        <div class="px-3 py-1 text-sm rounded-full" style="background: var(--hover-bg); color: var(--text-secondary);">
                            {{ $album->songs->count() }} tracks
                        </div>
                    </div>

                    @if ($album->songs->isEmpty())
                        <div class="py-12 text-center empty-state rounded-2xl">
                            <div class="mb-4 text-6xl">🎵</div>
                            <h4 class="mb-2 text-lg font-semibold" style="color: var(--text-primary);">
                                No songs in this album yet
                            </h4>
                            <p class="text-sm" style="color: var(--text-secondary);">
                                Add your first track using the form above
                            </p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($album->songs as $index => $song)
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
                                                {{ $album->title }} • {{ $album->user->name }}
                                                @if($song->duration)
                                                    • {{ $song->duration }}
                                                @endif
                                                @if($song->path)
                                                    • {{ strtoupper(pathinfo($song->path, PATHINFO_EXTENSION)) }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <!-- Play Button -->
                                        @if($song->path)
                                            <button class="play-btn" onclick="playSong('{{ $song->title }}', '{{ $album->user->name }}', '{{ $album->cover_image ? asset('storage/' . $album->cover_image) : '' }}', '{{ asset('storage/' . $song->path) }}')">
                                                <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </button>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('songs.destroy', $song) }}"
                                              method="POST"
                                              onsubmit="return confirm('{{ __('Are you sure you want to delete this song?') }}')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="flex items-center gap-1 px-4 py-2 rounded-lg danger-btn">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="text-sm">Delete</span>
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

        function previewAudio(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('audio-name').textContent = file.name;
                document.getElementById('audio-placeholder').classList.add('hidden');
                document.getElementById('audio-preview').classList.remove('hidden');
            }
        }

        function playSong(title, artist, cover, audioPath) {
            // Integration with your audio player
            if (typeof playSong === 'function') {
                playSong(title, artist, cover, audioPath);
            } else {
                console.log('Playing:', title);
            }
        }

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let valid = true;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            valid = false;
                            field.focus();
                        }
                    });

                    if (!valid) {
                        e.preventDefault();
                        alert('Please fill in all required fields');
                    }
                });
            });
        });
    </script>
</x-app-layout>
