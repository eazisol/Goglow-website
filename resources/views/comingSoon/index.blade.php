<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | Glaura</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow: hidden;
        }

        .coming-soon-page {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            /* Gradient matching the reference image: black top-left to magenta bottom-right */
            background: linear-gradient(135deg, #000000 0%, #0a0005 40%, #3d0a24 70%, #D10A5B 100%);
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Logo */
        .brand-logo {
            max-width: 140px;
            height: auto;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out forwards;
        }

        /* Coming Soon Text */
        .coming-soon-text {
            font-size: clamp(3rem, 8vw, 5rem);
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out forwards, smoothBounce 3s ease-in-out 1s infinite;
            opacity: 0;
        }

        @keyframes smoothBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* Headline */
        .headline {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 15px;
            animation: fadeIn 1s ease-out 0.4s forwards;
            opacity: 0;
        }

        /* Subtext */
        .subtext {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 400;
            animation: fadeIn 1s ease-out 0.6s forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="coming-soon-page">
        <div class="content">
            <!-- Logo -->
            <img src="{{ asset('images/loginuplogo.png') }}" alt="Glaura" class="brand-logo">

            <!-- Coming Soon Label -->
            <p class="coming-soon-text">Coming Soon</p>

            <!-- Main Text -->
            {{-- <h1 class="headline">Manage. Glam. Repeat.</h1> --}}
            <p class="subtext">Level up your beauty business with ease.</p>
        </div>
    </div>
</body>
</html>
