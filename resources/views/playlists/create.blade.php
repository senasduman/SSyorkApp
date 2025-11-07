<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Playlist') }}
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

        .icon-wrapper {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .icon-wrapper:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
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

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        .error-message {
            color: #ef4444;
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
                                <span class="mr-3 text-4xl">🎵</span>
                                {{ __('Create New Playlist') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Organize your favorite music into custom collections
                            </p>
                        </div>
                        <div class="text-4xl">📝</div>
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

            <!-- Playlist Creation Form -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Playlist Details</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Basic information about your playlist</p>
                        </div>
                    </div>

                    <form action="{{ route('playlists.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

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
                                           value="{{ old('name') }}"
                                           class="block w-full px-4 py-3 input-field rounded-xl"
                                           placeholder="Enter your playlist name..."
                                           required>
                                    @error('name')
                                        <p class="mt-1 text-sm error-message">{{ $message }}</p>
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
                                              placeholder="Describe your playlist...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm error-message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Privacy Settings -->
                                <div>
                                    <label class="block mb-3 text-sm font-medium label">
                                        Privacy Settings
                                    </label>
                                    <div class="privacy-toggle">
                                        <div class="space-y-2">
                                            <div class="privacy-option" onclick="selectPrivacy('public')">
                                                <input type="radio"
                                                       name="is_public"
                                                       value="1"
                                                       id="public"
                                                       class="hidden">
                                                <div class="flex items-center justify-center w-5 h-5 border-2 border-current rounded-full">
                                                    <div class="w-2 h-2 transition-opacity bg-current rounded-full opacity-0" id="public-dot"></div>
                                                </div>
                                                <div>
                                                    <div class="font-medium">🌍 Public</div>
                                                    <div class="text-xs opacity-75">Anyone can find and listen to this playlist</div>
                                                </div>
                                            </div>
                                            <div class="privacy-option selected" onclick="selectPrivacy('private')">
                                                <input type="radio"
                                                       name="is_public"
                                                       value="0"
                                                       id="private"
                                                       class="hidden"
                                                       checked>
                                                <div class="flex items-center justify-center w-5 h-5 border-2 border-current rounded-full">
                                                    <div class="w-2 h-2 transition-opacity bg-current rounded-full" id="private-dot"></div>
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
                                    Playlist Cover
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
                                            Drop your cover image here
                                        </h4>
                                        <p class="text-sm" style="color: var(--text-secondary);">
                                            Or click to browse files
                                        </p>
                                        <p class="mt-2 text-xs" style="color: var(--text-secondary);">
                                            JPG, PNG, GIF up to 10MB
                                        </p>
                                    </div>

                                    <div id="image-preview-container" class="hidden">
                                        <img id="image_preview"
                                             src="#"
                                             alt="Cover Preview"
                                             class="object-cover w-full h-48 mx-auto preview-image">
                                        <p class="mt-4 text-sm" style="color: var(--text-secondary);">
                                            Click to change image
                                        </p>
                                    </div>
                                </div>

                                @error('cover_image')
                                    <p class="mt-1 text-sm error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                    class="flex items-center gap-2 px-8 py-3 font-semibold primary-btn rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Create Playlist') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Pro Tips</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Make your playlist stand out</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 rounded-xl" style="background: var(--hover-bg);">
                            <div class="flex items-start gap-3">
                                <div class="text-2xl">🎯</div>
                                <div>
                                    <h4 class="mb-1 font-semibold" style="color: var(--text-primary);">Choose a Clear Name</h4>
                                    <p class="text-sm" style="color: var(--text-secondary);">Use descriptive names that reflect the mood or genre</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl" style="background: var(--hover-bg);">
                            <div class="flex items-start gap-3">
                                <div class="text-2xl">🎨</div>
                                <div>
                                    <h4 class="mb-1 font-semibold" style="color: var(--text-primary);">Add Cover Art</h4>
                                    <p class="text-sm" style="color: var(--text-secondary);">Eye-catching covers make playlists more appealing</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl" style="background: var(--hover-bg);">
                            <div class="flex items-start gap-3">
                                <div class="text-2xl">📝</div>
                                <div>
                                    <h4 class="mb-1 font-semibold" style="color: var(--text-primary);">Write Descriptions</h4>
                                    <p class="text-sm" style="color: var(--text-secondary);">Help others understand what your playlist is about</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl" style="background: var(--hover-bg);">
                            <div class="flex items-start gap-3">
                                <div class="text-2xl">🔒</div>
                                <div>
                                    <h4 class="mb-1 font-semibold" style="color: var(--text-primary);">Privacy Control</h4>
                                    <p class="text-sm" style="color: var(--text-secondary);">You can always change privacy settings later</p>
                                </div>
                            </div>
                        </div>
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
            const name = document.getElementById('name').value.trim();
            if (!name) {
                e.preventDefault();
                alert('Please enter a playlist name');
                document.getElementById('name').focus();
            }
        });

        // Initialize privacy selection
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('private-dot').style.opacity = '1';
        });
    </script>
</x-app-layout>
