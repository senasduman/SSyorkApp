<div id="playerBar" class="fixed bottom-0 left-0 right-0 z-50 hidden" style="background: var(--secondary-bg); border-top: 1px solid var(--border-color);">
    <div class="px-4 py-3 mx-auto max-w-7xl">
        <!-- Progress Bar -->
        <div class="mb-3">
            <div class="flex items-center justify-between mb-1 text-xs" style="color: var(--text-secondary);">
                <span id="currentTime">0:00</span>
                <span id="totalTime">0:00</span>
            </div>
            <div class="relative w-full h-2 rounded-full cursor-pointer" id="progressContainer" style="background: var(--border-color);">
                <div class="h-2 transition-all duration-150 rounded-full" id="progressBar" style="width: 0%; background: var(--accent-color);"></div>
                <div class="absolute top-0 w-3 h-3 rounded-full transform -translate-y-0.5 transition-opacity duration-200 opacity-0" id="progressThumb" style="background: var(--accent-color); left: 0%;"></div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <!-- Song Info -->
            <div class="flex items-center flex-1 min-w-0 gap-4">
                <img id="coverImage" src="" alt="Cover" class="object-cover w-12 h-12 rounded shadow-md">
                <div class="flex-1 min-w-0">
                    <p id="songTitle" class="text-sm font-semibold truncate max-w-48" style="color: var(--text-primary);"></p>
                    <p id="artistName" class="text-xs truncate max-w-48" style="color: var(--text-secondary);"></p>
                </div>
            </div>

            <!-- Controls -->
            <div class="flex items-center gap-4">
                <!-- Previous Button -->
                <button onclick="previousSong()" class="p-2 transition-colors rounded-full hover:bg-white hover:bg-opacity-10" style="color: var(--text-secondary);">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
                    </svg>
                </button>

                <!-- Play/Pause Button -->
                <button onclick="togglePlay()" id="playButton" class="p-3 transition-colors rounded-full" style="background: var(--accent-color);">
                    <svg id="playIcon" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <svg id="pauseIcon" class="hidden w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                    </svg>
                </button>

                <!-- Next Button -->
                <button onclick="nextSong()" class="p-2 transition-colors rounded-full hover:bg-white hover:bg-opacity-10" style="color: var(--text-secondary);">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                    </svg>
                </button>
            </div>

            <!-- Volume Control -->
            <div class="flex items-center justify-end flex-1 gap-2">
                <button onclick="toggleMute()" class="p-2 transition-colors rounded-full hover:bg-white hover:bg-opacity-10" style="color: var(--text-secondary);">
                    <svg id="volumeIcon" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                    </svg>
                    <svg id="muteIcon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
                    </svg>
                </button>
                <div class="relative w-20 h-2 rounded-full cursor-pointer" id="volumeContainer" style="background: var(--border-color);">
                    <div class="h-2 transition-all duration-200 rounded-full" id="volumeBar" style="width: 50%; background: var(--accent-color);"></div>
                </div>
            </div>
        </div>
    </div>

    <audio id="audioPlayer" preload="metadata"></audio>
</div>

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

    #progressContainer:hover #progressThumb {
        opacity: 1;
    }

    #progressContainer:hover {
        transform: scaleY(1.2);
        transition: transform 0.2s ease;
    }

    #volumeContainer:hover {
        transform: scaleY(1.2);
        transition: transform 0.2s ease;
    }
</style>

<script>
    class AudioPlayerManager {
        constructor() {
            this.audio = document.getElementById('audioPlayer');
            this.playIcon = document.getElementById('playIcon');
            this.pauseIcon = document.getElementById('pauseIcon');
            this.volumeIcon = document.getElementById('volumeIcon');
            this.muteIcon = document.getElementById('muteIcon');
            this.progressBar = document.getElementById('progressBar');
            this.progressContainer = document.getElementById('progressContainer');
            this.progressThumb = document.getElementById('progressThumb');
            this.volumeBar = document.getElementById('volumeBar');
            this.volumeContainer = document.getElementById('volumeContainer');
            this.currentTimeDisplay = document.getElementById('currentTime');
            this.totalTimeDisplay = document.getElementById('totalTime');

            this.currentPlaylist = [];
            this.currentIndex = 0;
            this.isPlaying = false;
            this.isDragging = false;

            this.init();
        }

        init() {
            // Load saved state
            this.loadPlayerState();

            // Audio event listeners
            this.audio.addEventListener('loadedmetadata', () => this.updateDuration());
            this.audio.addEventListener('timeupdate', () => {
                if (!this.isDragging) {
                    this.updateProgress();
                }
            });
            this.audio.addEventListener('ended', () => this.nextSong());
            this.audio.addEventListener('play', () => this.handlePlayState());
            this.audio.addEventListener('pause', () => this.handlePauseState());

            // Enhanced progress bar interactions
            this.progressContainer.addEventListener('mousedown', (e) => this.startDragging(e));
            this.progressContainer.addEventListener('mousemove', (e) => this.onDrag(e));
            this.progressContainer.addEventListener('mouseup', (e) => this.stopDragging(e));
            this.progressContainer.addEventListener('mouseleave', (e) => this.stopDragging(e));
            this.progressContainer.addEventListener('click', (e) => this.seekTo(e));

            // Volume control
            this.volumeContainer.addEventListener('click', (e) => this.setVolume(e));

            // Save state periodically
            setInterval(() => this.savePlayerState(), 1000);

            // Save state before page unload
            window.addEventListener('beforeunload', () => this.savePlayerState());
        }

        startDragging(e) {
            this.isDragging = true;
            this.updateProgressFromMouse(e);
        }

        onDrag(e) {
            if (this.isDragging) {
                this.updateProgressFromMouse(e);
            }
        }

        stopDragging(e) {
            if (this.isDragging) {
                this.isDragging = false;
                this.seekTo(e);
            }
        }

        updateProgressFromMouse(e) {
            if (!this.audio.duration) return;

            const rect = this.progressContainer.getBoundingClientRect();
            const percent = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));

            this.progressBar.style.width = (percent * 100) + '%';
            this.progressThumb.style.left = (percent * 100) + '%';

            const time = percent * this.audio.duration;
            this.currentTimeDisplay.textContent = this.formatTime(time);
        }

        playSong(title, artist, cover, audioPath, playlist = null) {
            if (playlist) {
                this.currentPlaylist = playlist;
                this.currentIndex = playlist.findIndex(song => song.audioPath === audioPath);
            }

            document.getElementById('songTitle').textContent = title;
            document.getElementById('artistName').textContent = artist;
            document.getElementById('coverImage').src = cover;
            this.audio.src = audioPath;

            // Reset progress
            this.progressBar.style.width = '0%';
            this.progressThumb.style.left = '0%';
            this.currentTimeDisplay.textContent = '0:00';
            this.totalTimeDisplay.textContent = '0:00';

            this.audio.play();
            document.getElementById('playerBar').classList.remove('hidden');
        }

        togglePlay() {
            if (this.audio.paused) {
                this.audio.play();
            } else {
                this.audio.pause();
            }
        }

        handlePlayState() {
            this.isPlaying = true;
            this.playIcon.classList.add('hidden');
            this.pauseIcon.classList.remove('hidden');
        }

        handlePauseState() {
            this.isPlaying = false;
            this.playIcon.classList.remove('hidden');
            this.pauseIcon.classList.add('hidden');
        }

        previousSong() {
            if (this.currentPlaylist.length > 0) {
                this.currentIndex = (this.currentIndex - 1 + this.currentPlaylist.length) % this.currentPlaylist.length;
                const song = this.currentPlaylist[this.currentIndex];
                this.playSong(song.title, song.artist, song.cover, song.audioPath);
            }
        }

        nextSong() {
            if (this.currentPlaylist.length > 0) {
                this.currentIndex = (this.currentIndex + 1) % this.currentPlaylist.length;
                const song = this.currentPlaylist[this.currentIndex];
                this.playSong(song.title, song.artist, song.cover, song.audioPath);
            }
        }

        updateProgress() {
            if (this.audio.duration && !this.isDragging) {
                const progress = (this.audio.currentTime / this.audio.duration) * 100;
                this.progressBar.style.width = progress + '%';
                this.progressThumb.style.left = progress + '%';
                this.currentTimeDisplay.textContent = this.formatTime(this.audio.currentTime);
            }
        }

        updateDuration() {
            if (this.audio.duration) {
                this.totalTimeDisplay.textContent = this.formatTime(this.audio.duration);
            }
        }

        seekTo(e) {
            if (!this.audio.duration) {
                console.log('Audio not ready for seeking');
                return;
            }

            const rect = this.progressContainer.getBoundingClientRect();
            const percent = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
            const newTime = percent * this.audio.duration;

            // Check if the new time is valid
            if (isNaN(newTime) || newTime < 0 || newTime > this.audio.duration) {
                console.log('Invalid seek time:', newTime);
                return;
            }

            this.audio.currentTime = newTime;
            this.updateProgress();
        }

        toggleMute() {
            if (this.audio.muted) {
                this.audio.muted = false;
                this.volumeIcon.classList.remove('hidden');
                this.muteIcon.classList.add('hidden');
            } else {
                this.audio.muted = true;
                this.volumeIcon.classList.add('hidden');
                this.muteIcon.classList.remove('hidden');
            }
        }

        setVolume(e) {
            const rect = this.volumeContainer.getBoundingClientRect();
            const percent = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
            this.audio.volume = percent;
            this.volumeBar.style.width = (percent * 100) + '%';

            if (this.audio.volume === 0) {
                this.audio.muted = true;
                this.volumeIcon.classList.add('hidden');
                this.muteIcon.classList.remove('hidden');
            } else {
                this.audio.muted = false;
                this.volumeIcon.classList.remove('hidden');
                this.muteIcon.classList.add('hidden');
            }
        }

        formatTime(seconds) {
            if (isNaN(seconds) || seconds < 0) return '0:00';
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        }

        savePlayerState() {
            if (this.audio.src) {
                const state = {
                    src: this.audio.src,
                    currentTime: this.audio.currentTime,
                    volume: this.audio.volume,
                    muted: this.audio.muted,
                    title: document.getElementById('songTitle').textContent,
                    artist: document.getElementById('artistName').textContent,
                    cover: document.getElementById('coverImage').src,
                    isVisible: !document.getElementById('playerBar').classList.contains('hidden')
                };
                localStorage.setItem('audioPlayerState', JSON.stringify(state));
            }
        }

        loadPlayerState() {
            const savedState = localStorage.getItem('audioPlayerState');
            if (savedState) {
                const state = JSON.parse(savedState);

                if (state.isVisible) {
                    document.getElementById('playerBar').classList.remove('hidden');
                    document.getElementById('songTitle').textContent = state.title;
                    document.getElementById('artistName').textContent = state.artist;
                    document.getElementById('coverImage').src = state.cover;

                    this.audio.src = state.src;

                    // Set volume and mute state first
                    this.audio.volume = state.volume || 0.5;
                    this.audio.muted = state.muted || false;
                    this.volumeBar.style.width = (this.audio.volume * 100) + '%';

                    if (state.muted) {
                        this.volumeIcon.classList.add('hidden');
                        this.muteIcon.classList.remove('hidden');
                    }

                    // Set current time when metadata is loaded
                    this.audio.addEventListener('loadedmetadata', () => {
                        if (state.currentTime && state.currentTime < this.audio.duration) {
                            this.audio.currentTime = state.currentTime;
                        }
                    }, { once: true });
                }
            }
        }
    }

    // Initialize the audio player
    const audioPlayer = new AudioPlayerManager();

    // Global functions for backward compatibility
    function togglePlay() {
        audioPlayer.togglePlay();
    }

    function previousSong() {
        audioPlayer.previousSong();
    }

    function nextSong() {
        audioPlayer.nextSong();
    }

    function toggleMute() {
        audioPlayer.toggleMute();
    }

    function playSong(title, artist, cover, audioPath, playlist = null) {
        audioPlayer.playSong(title, artist, cover, audioPath, playlist);
    }
</script>
