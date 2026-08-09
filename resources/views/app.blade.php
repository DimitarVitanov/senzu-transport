<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#0a0a0a">
        <meta name="author" content="Senzu Transport & Logistics">
        <meta property="og:site_name" content="Senzu Transport & Logistics">
        <meta property="og:locale" content="en_AU">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@senzutransport">
        <meta name="geo.region" content="AU-QLD">
        <meta name="geo.placename" content="Brisbane">
        <title inertia>{{ $seo['title'] ?? config('app.name', 'Senzu Transport') }}</title>
        <meta name="description" content="{{ $seo['description'] ?? '' }}">
        <meta name="keywords" content="{{ $seo['keywords'] ?? '' }}">
        <link rel="canonical" href="{{ $seo['url'] ?? 'https://senzutransport.com.au' }}">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $seo['url'] ?? '' }}">
        <meta property="og:title" content="{{ $seo['title'] ?? '' }}">
        <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
        <meta property="og:image" content="{{ $seo['image'] ?? '' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">

        <!-- Twitter -->
        <meta name="twitter:title" content="{{ $seo['title'] ?? '' }}">
        <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
        <meta name="twitter:image" content="{{ $seo['image'] ?? '' }}">

        <link rel="icon" type="image/png" href="/icons/truck-favi.png">
        <link rel="shortcut icon" type="image/png" href="/icons/truck-favi.png">
        <link rel="apple-touch-icon" href="/icons/truck-favi.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
        <script type="application/ld+json">{!! $seo['jsonld'] ?? '' !!}</script>
    </head>
    <body class="antialiased" style="overflow:hidden">
        <!-- Page Loader -->
        <div id="page-loader">
            <div class="loader-inner">
                <div class="loader-mark">
                    <div class="loader-ring"></div>
                    <div class="loader-ring loader-ring-soft"></div>
                    <div class="loader-icon">
                        <svg viewBox="0 0 24 24" fill="#0a0a0a">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                    </div>
                </div>
                <div class="loader-text">Preparing your delivery experience...</div>
                <div class="loader-bar"><div class="loader-bar-fill"></div></div>
            </div>
        </div>
        <style>
            #page-loader {
                position: fixed;
                inset: 0;
                z-index: 9999;
                background:
                    radial-gradient(circle at 20% 20%, rgba(138, 197, 7, 0.12), transparent 45%),
                    radial-gradient(circle at 80% 75%, rgba(56, 189, 248, 0.1), transparent 50%),
                    #060a10;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: opacity 0.55s ease, visibility 0.55s ease;
            }
            #page-loader.loaded {
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
            }
            .loader-inner {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 18px;
                transform: translateY(0);
                transition: transform 0.55s ease, opacity 0.55s ease;
            }
            #page-loader.loaded .loader-inner {
                transform: translateY(-8px);
                opacity: 0;
            }
            .loader-mark {
                position: relative;
                width: 90px;
                height: 90px;
                display: grid;
                place-items: center;
            }
            .loader-ring {
                position: absolute;
                inset: 0;
                border-radius: 9999px;
                border: 1.5px solid rgba(138, 197, 7, 0.5);
                animation: loaderRotate 3.2s linear infinite;
            }
            .loader-ring-soft {
                inset: 8px;
                border-color: rgba(255, 255, 255, 0.2);
                animation-direction: reverse;
                animation-duration: 2.4s;
            }
            .loader-icon {
                width: 52px;
                height: 52px;
                background: #8ac507;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 35px rgba(138, 197, 7, 0.35);
                animation: loaderPulse 1.8s ease-in-out infinite;
            }
            .loader-icon svg {
                width: 28px;
                height: 28px;
            }
            .loader-text {
                font-family: Inter, sans-serif;
                font-size: 12px;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                color: rgba(226, 232, 240, 0.85);
            }
            .loader-bar {
                width: 170px;
                height: 3px;
                background: rgba(255, 255, 255, 0.12);
                border-radius: 3px;
                overflow: hidden;
            }
            .loader-bar-fill {
                height: 100%;
                width: 45%;
                background: linear-gradient(90deg, #8ac507 0%, #c8f23b 100%);
                border-radius: 3px;
                animation: loaderSlide 1.25s ease-in-out infinite;
            }
            @keyframes loaderPulse {
                0%, 100% { transform: scale(1); opacity: 1; }
                50% { transform: scale(0.92); opacity: 0.8; }
            }
            @keyframes loaderRotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            @keyframes loaderSlide {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(350%); }
            }
        </style>

        @inertia
    </body>
</html>
