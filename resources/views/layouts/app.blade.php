<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Ssyork</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Flash Messages -->
            @if(session('success') || session('error') || session('warning') || session('info'))
                <div id="flash-message" class="fixed z-50 max-w-md transition-all duration-300 transform translate-x-full top-4 right-4">
                    @if(session('success'))
                        <div class="relative flex items-center p-4 text-white bg-green-500 shadow-lg rounded-xl">
                            <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="pr-8 font-medium">{{ session('success') }}</span>
                            <button onclick="closeFlashMessage()" class="absolute text-white transition-colors top-2 right-2 hover:text-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="relative flex items-center p-4 text-white bg-red-500 shadow-lg rounded-xl">
                            <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="pr-8 font-medium">{{ session('error') }}</span>
                            <button onclick="closeFlashMessage()" class="absolute text-white transition-colors top-2 right-2 hover:text-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="relative flex items-center p-4 text-white bg-yellow-500 shadow-lg rounded-xl">
                            <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="pr-8 font-medium">{{ session('warning') }}</span>
                            <button onclick="closeFlashMessage()" class="absolute text-white transition-colors top-2 right-2 hover:text-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="relative flex items-center p-4 text-white bg-blue-500 shadow-lg rounded-xl">
                            <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="pr-8 font-medium">{{ session('info') }}</span>
                            <button onclick="closeFlashMessage()" class="absolute text-white transition-colors top-2 right-2 hover:text-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                <script>
                    // Auto-show and hide flash messages
                    document.addEventListener('DOMContentLoaded', function() {
                        const flashMessage = document.getElementById('flash-message');
                        if (flashMessage) {
                            // Show the message by sliding it in
                            setTimeout(() => {
                                flashMessage.classList.remove('translate-x-full');
                            }, 100);

                            // Auto-hide after 5 seconds
                            setTimeout(() => {
                                flashMessage.classList.add('translate-x-full');
                                setTimeout(() => {
                                    if (flashMessage.parentNode) {
                                        flashMessage.remove();
                                    }
                                }, 300);
                            }, 5000);
                        }
                    });

                    function closeFlashMessage() {
                        const flashMessage = document.getElementById('flash-message');
                        if (flashMessage) {
                            flashMessage.classList.add('translate-x-full');
                            setTimeout(() => {
                                if (flashMessage.parentNode) {
                                    flashMessage.remove();
                                }
                            }, 300);
                        }
                    }
                </script>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
