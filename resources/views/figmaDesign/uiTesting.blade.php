<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How GlowApp Fills Your Calendar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fef3f7 0%, #fff9f5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .fills-your-calender {
            max-width: 1200px;
            width: 100%;
        }

        .header-badge {
            display: inline-block;
            background: #ffe0ec;
            color: #d946a6;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 6px;
            text-align: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .header-badge::after {
            content: "➜";
            font-size: 14px;
        }

        .title-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .title-section h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .title-section h1 .highlight-pink {
            color: #d946a6;
        }

        .title-section h1 .highlight-orange {
            color: #ff8c42;
        }

        .title-section h2 {
            font-size: 36px;
            font-weight: 400;
            color: #6b5b4f;
            font-style: italic;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #999;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .container {
            position: relative;
            width: 100%;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .center-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 10;
        }

        .glow-icon {
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8c42 50%, #d946a6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
            box-shadow: 0 20px 60px rgba(255, 107, 107, 0.3);
        }

        .glow-icon::before {
            content: "◉";
            font-size: 80px;
            color: white;
        }

        .glow-text {
            font-size: 60px;
            font-weight: 700;
            background: linear-gradient(90deg, #d946a6 0%, #ff8c42 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
        }

        .phone-mockup {
            position: absolute;
            width: 140px;
            background: white;
            border-radius: 30px;
            border: 8px solid #333;
            padding: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .phone-screen {
            width: 100%;
            height: 280px;
            background: linear-gradient(135deg, #e0f2ff 0%, #fff5f1 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #999;
            text-align: center;
            padding: 10px;
        }

        .phone-1 { top: 30px; left: 20px; }
        .phone-2 { top: 30px; right: 20px; }
        .phone-3 { bottom: 30px; left: 20px; }
        .phone-4 { bottom: 30px; right: 20px; }

        .label {
            position: absolute;
            background: white;
            border: 2px solid #ff1493;
            border-radius: 20px;
            padding: 8px 12px;
            font-size: 11px;
            font-weight: 600;
            color: #ff1493;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .label-1 { top: 100px; left: -80px; }
        .label-2 { top: 80px; right: -100px; }
        .label-3 { bottom: 120px; left: -95px; }
        .label-4 { bottom: 100px; right: -110px; }

        .decorative-star {
            position: absolute;
            color: #ff8c42;
            font-size: 24px;
        }

        .star-1 { top: 60px; right: 35%; }
        .star-2 { bottom: 40%; right: 10%; }

        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #ff1493 0%, #ff8c42 100%);
            color: white;
            padding: 14px 32px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 20, 147, 0.4);
        }

        .button-container {
            text-align: center;
        }

        @media (max-width: 768px) {
            .title-section h1 {
                font-size: 32px;
            }

            .title-section h2 {
                font-size: 24px;
            }

            .phone-mockup {
                width: 100px;
            }

            .phone-screen {
                height: 200px;
            }

            .glow-icon {
                width: 120px;
                height: 120px;
            }

            .glow-text {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="fills-your-calender">
        <div style="text-align: center;">
            <div class="header-badge">How it Works</div>
            
            <div class="title-section">
                <h1>How <span class="highlight-pink">GlowApp</span> <span class="highlight-orange">Fills</span> Your</h1>
                <h2>Calendar (in 5 clicks)</h2>
                <p class="subtitle">Proof that it works. average results from our 2,847 beauty pros.</p>
            </div>

            <div class="container">
                <div class="phone-mockup phone-1">
                    <div class="phone-screen">Screen 1</div>
                </div>
                <div class="phone-mockup phone-2">
                    <div class="phone-screen">Screen 2</div>
                </div>
                <div class="phone-mockup phone-3">
                    <div class="phone-screen">Screen 3</div>
                </div>
                <div class="phone-mockup phone-4">
                    <div class="phone-screen">Screen 4</div>
                </div>

                <div class="center-logo">
                    <div class="glow-icon"></div>
                    <div class="glow-text">glow</div>
                </div>

                <div class="label label-1">Your Title Here</div>
                <div class="label label-2">Your Title Here</div>
                <div class="label label-3">Your Title Here</div>
                <div class="label label-4">Your Title Here</div>

                <div class="decorative-star star-1">✦</div>
                <div class="decorative-star star-2">✦</div>
            </div>

            <div class="button-container">
                <button class="cta-button">BECOME A BLOGGER ➜</button>
            </div>
        </div>
    </div>
</body>
</html>