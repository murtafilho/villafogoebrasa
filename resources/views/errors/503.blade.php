<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Em Breve - Villa Fogo & Brasa</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --villa-charcoal: #1a1714;
            --villa-espresso: #2d2520;
            --villa-coffee: #3d3530;
            --villa-ember: #c45c26;
            --villa-flame: #e07830;
            --villa-gold: #d4a853;
            --villa-cream: #f5f0e8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, var(--villa-charcoal) 0%, var(--villa-espresso) 50%, #0d0b0a 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--villa-cream);
            position: relative;
            overflow: hidden;
        }

        /* Background texture */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4a853' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Glow effect */
        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(196, 92, 38, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        .glow-1 { top: -100px; left: -100px; }
        .glow-2 { bottom: -100px; right: -100px; animation-delay: 2s; }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }

        .container {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 10;
            max-width: 600px;
        }

        .logo {
            width: 180px;
            height: auto;
            margin-bottom: 3rem;
            filter: drop-shadow(0 4px 20px rgba(212, 168, 83, 0.3));
        }

        .title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            font-weight: 600;
            color: var(--villa-gold);
            margin-bottom: 1rem;
            letter-spacing: 0.05em;
        }

        .subtitle {
            font-size: 1.25rem;
            color: rgba(245, 240, 232, 0.7);
            margin-bottom: 3rem;
            line-height: 1.8;
        }

        .divider {
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--villa-ember), transparent);
            margin: 0 auto 3rem;
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            color: rgba(245, 240, 232, 0.8);
        }

        .info-item svg {
            width: 24px;
            height: 24px;
            color: var(--villa-ember);
        }

        .cta {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: var(--villa-ember);
            color: white;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(196, 92, 38, 0.4);
        }

        .cta:hover {
            background: var(--villa-flame);
            transform: translateY(-2px);
            box-shadow: 0 6px 30px rgba(196, 92, 38, 0.5);
        }

        .cta svg {
            width: 20px;
            height: 20px;
        }

        .footer {
            position: absolute;
            bottom: 2rem;
            color: rgba(245, 240, 232, 0.4);
            font-size: 0.875rem;
        }

        /* Fire animation */
        .fire-icon {
            display: inline-block;
            animation: flicker 1.5s ease-in-out infinite;
        }

        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @media (max-width: 640px) {
            .title { font-size: 2.5rem; }
            .subtitle { font-size: 1rem; }
            .logo { width: 140px; }
        }
    </style>
</head>
<body>
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>

    <div class="container">
        <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" class="logo">

        <h1 class="title">Em Breve</h1>

        <div class="divider"></div>

        <p class="subtitle">
            Estamos preparando uma experiência gastronômica única para você.<br>
            A autêntica churrascaria gaúcha em Nova Lima.
        </p>

        <div class="info">
            <div class="info-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Nova Lima, MG</span>
            </div>
            <div class="info-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span>(31) 98552-8192</span>
            </div>
        </div>

    </div>

    <p class="footer">
        <span class="fire-icon">🔥</span> Villa Fogo & Brasa © {{ date('Y') }}
    </p>
</body>
</html>
