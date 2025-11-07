<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SSyrok - Professional Music Streaming Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
    :root {
        --primary-bg: #121828; /* Ana koyu arka plan */
        --secondary-bg: #1F2A40; /* İçerik bloklarının arka planı */
        --sidebar-bg: #2A3A5E; /* Kenar çubuğu arka planı */
        --accent-color: #4A90E2; /* Vurgu rengi (mavi tonları) */
        --text-primary: #E0E0E0; /* Ana metin rengi */
        --text-secondary: #B0B0B0; /* İkincil metin rengi */
        --icon-color: #B0B0B0;
        --hover-bg: #3A4C7A;
        --border-color: #3A4C7A;

        /* Additional colors derived from your palette */
        --accent-hover: #3A7BC8;
        --text-muted: #8A9BA8;
        --card-bg: var(--secondary-bg);
        --gradient-primary: linear-gradient(135deg, #4A90E2 0%, #3A4C7A 100%);
        --gradient-secondary: linear-gradient(135deg, #3A7BC8 0%, #2A3A5E 100%);
        --gradient-tertiary: linear-gradient(135deg, #4A90E2 0%, #1F2A40 100%);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--primary-bg);
        color: var(--text-primary);
        line-height: 1.6;
        overflow-x: hidden;
    }

    /* Navigation */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background: rgba(31, 42, 64, 0.95); /* Using secondary-bg with opacity */
        backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border-color);
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 70px;
    }

    .logo {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .nav-link {
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
        padding: 8px 16px;
        border-radius: 6px;
    }

    .nav-link:hover {
        color: var(--text-primary);
        background: var(--hover-bg);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary {
        background: var(--accent-color);
        color: white;
    }

    .btn-primary:hover {
        background: var(--accent-hover);
        transform: translateY(-1px);
        box-shadow: 0 10px 25px rgba(74, 144, 226, 0.3);
    }

    .btn-outline {
        background: transparent;
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }

    .btn-outline:hover {
        background: var(--hover-bg);
        border-color: var(--accent-color);
    }

    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .hero-content {
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        background: rgba(74, 144, 226, 0.1);
        border: 1px solid rgba(74, 144, 226, 0.3);
        border-radius: 20px;
        color: var(--accent-color);
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 24px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 24px;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: var(--text-secondary);
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .hero-actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .hero-visual {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .music-player-mockup {
        background: var(--secondary-bg);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        border: 1px solid var(--border-color);
        max-width: 400px;
        width: 100%;
    }

    .player-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .player-title {
        font-weight: 600;
        color: var(--text-primary);
    }

    .player-controls {
        display: flex;
        gap: 8px;
    }

    .control-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--text-muted);
    }

    .album-art {
        width: 100%;
        height: 200px;
        background: var(--gradient-primary);
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .track-info {
        text-align: center;
        margin-bottom: 20px;
    }

    .track-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .track-artist {
        color: var(--text-secondary);
        font-size: 14px;
    }

    .progress-bar {
        height: 4px;
        background: var(--border-color);
        border-radius: 2px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        width: 35%;
        background: var(--accent-color);
        border-radius: 2px;
    }

    .player-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        align-items: center;
    }

    .play-btn {
        width: 50px;
        height: 50px;
        background: var(--accent-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .control-btn {
        width: 40px;
        height: 40px;
        background: transparent;
        border: none;
        color: var(--text-secondary);
        font-size: 16px;
        cursor: pointer;
    }

    /* Features Section */
    .features {
        padding: 120px 0;
        background: var(--secondary-bg);
    }

    .features-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .section-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        background: rgba(74, 144, 226, 0.1);
        border: 1px solid rgba(74, 144, 226, 0.3);
        border-radius: 20px;
        color: var(--accent-color);
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 16px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--text-primary);
    }

    .section-description {
        font-size: 1.125rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
    }

    .feature-card {
        background: var(--sidebar-bg);
        border-radius: 16px;
        padding: 40px 30px;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .feature-card:hover::before {
        opacity: 1;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-color);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        background: var(--hover-bg);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        background: var(--gradient-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 24px;
    }

    .feature-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-primary);
    }

    .feature-description {
        color: var(--text-secondary);
        line-height: 1.6;
    }

    /* Stats Section */
    .stats {
        padding: 80px 0;
        background: var(--primary-bg);
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        text-align: center;
    }

    .stat-item {
        padding: 20px;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--accent-color);
        margin-bottom: 8px;
    }

    .stat-label {
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* CTA Section */
    .cta {
        padding: 100px 0;
        background: var(--secondary-bg);
        text-align: center;
    }

    .cta-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-primary);
    }

    .cta-description {
        font-size: 1.125rem;
        color: var(--text-secondary);
        margin-bottom: 40px;
    }

    /* Footer */
    .footer {
        background: var(--primary-bg);
        border-top: 1px solid var(--border-color);
        padding: 60px 0 30px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-section h3 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 20px;
    }

    .footer-section a {
        color: var(--text-secondary);
        text-decoration: none;
        display: block;
        margin-bottom: 10px;
        transition: color 0.3s ease;
    }

    .footer-section a:hover {
        color: var(--accent-color);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid var(--border-color);
        color: var(--text-muted);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-container {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .nav-links {
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 13px;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .cta-title {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-content > * {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .hero-content > *:nth-child(2) { animation-delay: 0.1s; }
    .hero-content > *:nth-child(3) { animation-delay: 0.2s; }
    .hero-content > *:nth-child(4) { animation-delay: 0.3s; }
    </style>

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <img src="{{ asset('images/SSyorkappiconlarge.png') }}" alt="SSyrok" style="width: auto; height: 40px; object-fit: contain;">
            </a>

            @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('profile.show') }}" class="nav-link">Profile</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    🎉 Now Available - Premium Music Experience
                </div>

                <h1 class="hero-title">
                    The Future of<br>Music Streaming
                </h1>

                <p class="hero-subtitle">
                    Experience music like never before with SSyrok's cutting-edge platform.
                    Discover, stream, and share your favorite tracks with crystal-clear quality
                    and intelligent recommendations.
                </p>

                <div class="hero-actions">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary">Start Free Trial</a>
                        <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Open Dashboard</a>
                    @endguest
                </div>
            </div>

            <div class="hero-visual">
                <div class="music-player-mockup">
                    <div class="player-header">
                        <div class="player-title">Now Playing</div>
                        <div class="player-controls">
                            <div class="control-dot" style="background: #ff5f56;"></div>
                            <div class="control-dot" style="background: #ffbd2e;"></div>
                            <div class="control-dot" style="background: #27ca3f;"></div>
                        </div>
                    </div>

                    <div class="album-art">🎵</div>

                    <div class="track-info">
                        <div class="track-title">Summer Vibes</div>
                        <div class="track-artist">Artist Name</div>
                    </div>

                    <div class="progress-bar">
                        <div class="progress-fill"></div>
                    </div>

                    <div class="player-buttons">
                        <button class="control-btn">⏮</button>
                        <div class="play-btn">▶</div>
                        <button class="control-btn">⏭</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">10M+</div>
                    <div class="stat-label">Songs Available</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">500K+</div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Artists</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features-container">
            <div class="section-header">
                <div class="section-badge">✨ Features</div>
                <h2 class="section-title">Everything You Need</h2>
                <p class="section-description">
                    Powerful features designed to enhance your music experience and help you discover your next favorite song.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎧</div>
                    <h3 class="feature-title">High-Quality Audio</h3>
                    <p class="feature-description">
                        Stream music in lossless quality up to 24-bit/192kHz for the ultimate listening experience.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🤖</div>
                    <h3 class="feature-title">Smart Recommendations</h3>
                    <p class="feature-description">
                        Our AI-powered recommendation engine learns your taste and suggests music you'll love.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">Cross-Platform Sync</h3>
                    <p class="feature-description">
                        Access your music library across all devices with real-time synchronization.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🎵</div>
                    <h3 class="feature-title">Custom Playlists</h3>
                    <p class="feature-description">
                        Create unlimited playlists and organize your music exactly how you want it.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🌐</div>
                    <h3 class="feature-title">Social Features</h3>
                    <p class="feature-description">
                        Follow friends, share playlists, and discover what others are listening to.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Lightning Fast</h3>
                    <p class="feature-description">
                        Instant playback with our global CDN ensuring minimal buffering worldwide.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2 class="cta-title">Ready to Get Started?</h2>
            <p class="cta-description">
                Join millions of music lovers already using SSyrok. Start your journey today with a free account.
            </p>
            <div class="hero-actions">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Create Free Account</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Product</h3>
                    <a href="#">Features</a>
                    <a href="#">Pricing</a>
                    <a href="#">Mobile Apps</a>
                    <a href="#">Desktop App</a>
                </div>
                <div class="footer-section">
                    <h3>Company</h3>
                    <a href="#">About Us</a>
                    <a href="#">Careers</a>
                    <a href="#">Press</a>
                    <a href="#">Contact</a>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <a href="#">Help Center</a>
                    <a href="#">Community</a>
                    <a href="#">API Documentation</a>
                    <a href="#">Status</a>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                    <a href="#">DMCA</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SSyrok. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
