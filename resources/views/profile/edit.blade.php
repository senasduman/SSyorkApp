<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile Settings') }}
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

        .warning-btn {
            background: rgba(245, 158, 11, 0.9);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .warning-btn:hover {
            background: rgba(245, 158, 11, 1);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
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

        .profile-photo {
            border: 3px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .profile-photo:hover {
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

        .checkbox-custom {
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--hover-bg);
            border: 2px solid var(--border-color);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .checkbox-custom:checked {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
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
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 overflow-hidden shadow-xl content-card rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="flex items-center text-3xl font-bold" style="color: var(--text-primary);">
                                <span class="mr-3 text-4xl">👤</span>
                                {{ __('Profile Settings') }}
                            </h1>
                            <p class="mt-2 text-lg" style="color: var(--text-secondary);">
                                Manage your account information and preferences
                            </p>
                        </div>
                        <div class="text-4xl">⚙️</div>
                    </div>
                </div>
            </div>

            <!-- Success Messages -->
            @if (session('status') === 'profile-updated')
                <div class="p-4 mb-8 rounded-xl success-message">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span class="font-medium">{{ __('Profile updated successfully!') }}</span>
                    </div>
                </div>
            @endif

            <!-- Profile Information Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Personal Information</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Update your basic profile details</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            <!-- Left Column - Form Fields -->
                            <div class="space-y-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium label">
                                        {{ __('Full Name') }} *
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name', $user->name) }}"
                                           class="block w-full px-4 py-3 input-field rounded-xl"
                                           placeholder="Enter your full name..."
                                           required>
                                    @error('name')
                                        <p class="mt-1 text-sm error-message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium label">
                                        {{ __('Email Address') }} *
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           value="{{ old('email', $user->email) }}"
                                           class="block w-full px-4 py-3 input-field rounded-xl"
                                           placeholder="Enter your email address..."
                                           required>
                                    @error('email')
                                        <p class="mt-1 text-sm error-message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bio -->
                                <div>
                                    <label for="bio" class="block mb-2 text-sm font-medium label">
                                        {{ __('Biography') }}
                                    </label>
                                    <textarea name="bio"
                                              id="bio"
                                              rows="4"
                                              class="block w-full px-4 py-3 resize-none input-field rounded-xl"
                                              placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <p class="mt-1 text-sm error-message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Artist Status -->
                                <div class="p-4 rounded-xl" style="background: var(--hover-bg); border: 1px solid var(--border-color);">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox"
                                               name="is_artist"
                                               id="is_artist"
                                               value="1"
                                               class="checkbox-custom"
                                               {{ old('is_artist', $user->is_artist) ? 'checked' : '' }}>
                                        <div>
                                            <div class="font-medium" style="color: var(--text-primary);">🎤 Artist Account</div>
                                            <div class="text-xs" style="color: var(--text-secondary);">Enable artist features and upload capabilities</div>
                                        </div>
                                    </label>
                                    @error('is_artist')
                                        <p class="mt-2 text-sm error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right Column - Profile Photo -->
                            <div>
                                <label class="block mb-3 text-sm font-medium label">
                                    Profile Photo
                                </label>

                                <!-- Current Photo Display -->
                                <div class="mb-4 text-center">
                                    @if ($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                             alt="Profile Photo"
                                             id="current_photo"
                                             class="object-cover w-32 h-32 mx-auto rounded-full profile-photo">
                                    @else
                                        <div class="flex items-center justify-center w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-gray-600 to-gray-800">
                                            <div class="text-center">
                                                <div class="mb-1 text-4xl text-white opacity-80">👤</div>
                                                <p class="text-xs text-white opacity-60">No Photo</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Upload Area -->
                                <div class="p-6 text-center file-upload-area rounded-xl"
                                     onclick="document.getElementById('profile_photo').click()">
                                    <input type="file"
                                           name="profile_photo"
                                           id="profile_photo"
                                           class="hidden"
                                           accept="image/*"
                                           onchange="previewProfilePhoto(event)">
                                    <div class="mb-2 text-4xl">📸</div>
                                    <p class="text-sm" style="color: var(--text-primary);">
                                        Click to change photo
                                    </p>
                                    <p class="mt-1 text-xs" style="color: var(--text-secondary);">
                                        JPG, PNG up to 5MB
                                    </p>
                                </div>

                                @error('profile_photo')
                                    <p class="mt-1 text-sm error-message">{{ $message }}</p>
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
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="mb-8 overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Security Settings</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Update your password and security preferences</p>
                        </div>
                    </div>

                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Account Deletion Section -->
            <div class="overflow-hidden shadow-xl form-section rounded-3xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 rounded-full icon-wrapper">
                            <svg class="w-6 h-6" style="color: var(--text-primary);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" style="color: var(--text-primary);">Danger Zone</h3>
                            <p class="text-sm" style="color: var(--text-secondary);">Permanently delete your account and all data</p>
                        </div>
                    </div>

                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewProfilePhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentPhoto = document.getElementById('current_photo');
                    if (currentPhoto) {
                        currentPhoto.src = e.target.result;
                    } else {
                        // Create new image element if no current photo exists
                        const photoContainer = document.querySelector('.file-upload-area').previousElementSibling;
                        photoContainer.innerHTML = `
                            <img src="${e.target.result}"
                                 alt="Profile Photo Preview"
                                 id="current_photo"
                                 class="object-cover w-32 h-32 mx-auto rounded-full profile-photo">
                        `;
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();

                if (!name || !email) {
                    e.preventDefault();
                    alert('Please fill in all required fields');
                }
            });
        });
    </script>
</x-app-layout>
