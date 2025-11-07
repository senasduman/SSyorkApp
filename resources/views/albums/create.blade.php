<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Album') }}
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

        .file-upload-area.dragover {
            border-color: var(--accent-color);
            background: var(--secondary-bg);
            transform: scale(1.02);
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

        .step-indicator {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
        }

        .step-active {
            background: var(--accent-color);
            color: white;
        }

        .progress-bar {
            background: var(--hover-bg);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(90deg, var(--accent-color) 0%, #5A9FE5 100%);
            transition: width 0.3s ease;
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
    </style>

    <div class="py-12 page-container">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 overflow-hidden shadow-xl content-card rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="flex items-center text-3xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-4xl">🎼</span>
                                {{ __('Create New Album') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Share your music with the world by creating a professional album
                            </p>
                        </div>
                        <div class="px-4 py-2 rounded-full step-indicator">
                            <span class="text-sm font-medium" style="color: var(--text-primary);">Step 1 of 2</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="h-2 mt-6 progress-bar">
                        <div class="h-full progress-fill" style="width: 50%;"></div>
                    </div>
                </div>
            </div>

            <!-- Album Creation Form -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Album Information</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Basic details about your album</p>
                        </div>
                    </div>

                    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title Field -->
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium label">
                                Album Title *
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="block w-full px-4 py-3 input-field rounded-xl"
                                   placeholder="Enter your album title..."
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
                                      placeholder="Tell people about your album..."></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cover Image Upload -->
                        <div>
                            <label for="cover_image" class="block mb-2 text-sm font-medium label">
                                Album Cover
                            </label>
                            <div class="p-8 text-center file-upload-area rounded-xl"
                                 onclick="document.getElementById('cover_image').click()"
                                 ondrop="dropHandler(event)"
                                 ondragover="dragOverHandler(event)"
                                 ondragleave="dragLeaveHandler(event)">
                                <input type="file"
                                       name="cover_image"
                                       id="cover_image"
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                <div id="upload-placeholder">
                                    <div class="mb-4 text-6xl">🖼️</div>
                                    <h4 class="mb-2 text-lg font-semibold" style="color: var(--text-primary);">
                                        Drop your album cover here
                                    </h4>
                                    <p class="text-sm" style="color: var(--text-secondary);">
                                        Or click to browse files (JPG, PNG, GIF up to 10MB)
                                    </p>
                                </div>
                                <div id="image-preview-container" class="hidden">
                                    <img id="image_preview"
                                         src="#"
                                         alt="Album Cover Preview"
                                         class="object-cover w-48 h-48 mx-auto preview-image">
                                    <p class="mt-4 text-sm" style="color: var(--text-secondary);">
                                        Click to change image
                                    </p>
                                </div>
                            </div>
                            @error('cover_image')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                    class="flex items-center gap-2 px-8 py-3 font-semibold primary-btn rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Create Album') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Songs Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Add Songs</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Upload tracks to your album</p>
                        </div>
                    </div>

                    <form action="{{ route('albums.addSong', ['album' => 'new']) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                                {{ __('Add Song to Album') }}
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
                                <h3 class="text-xl font-bold" style="color: var(--text-primary);">Album Tracks</h3>
                                <p class="text-sm" style="color: var(--text-secondary);">Songs in your album</p>
                            </div>
                        </div>
                        <div class="px-3 py-1 text-sm rounded-full" style="background: var(--hover-bg); color: var(--text-secondary);">
                            0 tracks
                        </div>
                    </div>

                    <div class="py-12 text-center" style="background: var(--hover-bg); border-radius: 16px; border: 2px dashed var(--border-color);">
                        <div class="mb-4 text-6xl">🎵</div>
                        <h4 class="mb-2 text-lg font-semibold" style="color: var(--text-primary);">
                            No songs added yet
                        </h4>
                        <p class="text-sm" style="color: var(--text-secondary);">
                            Start by creating your album and then add your first track above
                        </p>
                    </div>
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
                    document.getElementById('image_preview').src = e.target.result;
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('image-preview-container').classList.remove('hidden');
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

        function dropHandler(event) {
            event.preventDefault();
            event.target.classList.remove('dragover');

            const files = event.dataTransfer.files;
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                document.getElementById('cover_image').files = files;
                previewImage({target: {files: files}});
            }
        }

        function dragOverHandler(event) {
            event.preventDefault();
            event.target.classList.add('dragover');
        }

        function dragLeaveHandler(event) {
            event.target.classList.remove('dragover');
        }

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            if (!title) {
                e.preventDefault();
                alert('Please enter an album title');
                document.getElementById('title').focus();
            }
        });
    </script>
</x-app-layout>
