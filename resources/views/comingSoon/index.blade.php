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

        /* Countdown Styles */
        .countdown-container {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            animation: fadeIn 1s ease-out 0.8s forwards;
            opacity: 0;
            justify-content: center;
        }

        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 15px 20px;
            min-width: 90px;
            backdrop-filter: blur(5px);
        }

        .count {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            margin-bottom: 5px;
        }

        .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
        }

        .launched {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            animation: fadeIn 1s ease-out forwards;
        }

        @media (max-width: 600px) {
            .countdown-container {
                gap: 10px;
                flex-wrap: wrap;
            }
            .countdown-item {
                min-width: 70px;
                padding: 10px;
            }
            .count {
                font-size: 1.5rem;
            }
            .label {
                font-size: 0.7rem;
            }
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
            <p class="subtext">Level up your beauty business with ease.</p>

            <!-- Countdown Timer -->
            <div id="countdown" class="countdown-container">
                <div class="countdown-item">
                    <span class="count" id="days">00</span>
                    <span class="label">Days</span>
                </div>
                <div class="countdown-item">
                    <span class="count" id="hours">00</span>
                    <span class="label">Hours</span>
                </div>
                <div class="countdown-item">
                    <span class="count" id="minutes">00</span>
                    <span class="label">Mins</span>
                </div>
                <div class="countdown-item">
                    <span class="count" id="seconds">00</span>
                    <span class="label">Secs</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set the date we're counting down to: Jan 7, 2026
        // Assuming 00:00:00 start of day, or user might want end of day. Defaulting to midnight start of Jan 7.
        const countDownDate = new Date("Jan 7, 2026 00:00:00").getTime();

        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML =  days < 10 ? "0" + days : days;
            document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "<p class='launched'>WE ARE LIVE!</p>";
            }
        }, 1000);
    </script>
</body>
</html>
