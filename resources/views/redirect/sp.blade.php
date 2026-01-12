{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Glaura App</title>
    <!-- iOS Smart App Banner -->
    <meta name="apple-itunes-app" content="app-id=6743101981, app-argument=https://glaura.ai/sp?id={{ $spId }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }
        .container {
            padding: 40px;
            max-width: 600px;
        }
        h1 {
            color: #1a1a1a;
            font-size: 32px;
            margin-bottom: 16px;
        }
        p {
            color: #666;
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 40px;
        }
        .store-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .store-button {
            transition: transform 0.2s ease;
            display: inline-block;
        }
        .store-button:hover {
            transform: translateY(-2px);
        }
        .store-button img {
            height: 50px;
            width: auto;
            display: block;
        }
        #redirect-msg {
            margin-top: 30px;
            color: #888;
            font-size: 14px;
            display: none;
        }
        .logo {
            margin-bottom: 30px;
            width: 80px;
            height: 80px;
            background: #000; /* Placeholder for logo */
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Optional: Replace with actual Logo URL -->
        <!-- <img src="/path/to/logo.png" class="logo" alt="Glaura"> -->
        
        <h1>Download Glaura App</h1>
        <p>
            Experience the best beauty services at your fingertips. Download the app to book <span style="font-weight: 700; color: #000;">{{ $spId }}</span> and more.
        </p>
        
        <div class="store-buttons">
            <!-- iOS App Store Button -->
            <a href="https://apps.apple.com/app/id6743101981" class="store-button" id="iosBtn">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="Download on the App Store">
            </a>

            <!-- Google Play Store Button -->
            <a href="https://play.google.com/store/apps/details?id=com.salif.beautyapp" class="store-button" id="androidBtn">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play">
            </a>
        </div>

        <p id="redirect-msg">Opening app...</p>
    </div>

    <script type="text/javascript">
        // --- CONFIGURATION ---
        var ANDROID_PACKAGE = 'com.salif.beautyapp'; 
        var IOS_APP_ID = '6743101981'; 
        var SCHEME = 'glaura';
        var spId = "{{ $spId }}"; 
        
        var playStoreLink = 'https://play.google.com/store/apps/details?id=' + ANDROID_PACKAGE;
        var appStoreLink = 'https://apps.apple.com/app/id' + IOS_APP_ID;
        var appDeepLink = SCHEME + '://sp?id=' + spId;

        function redirect() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            var isAndroid = /android/i.test(userAgent);
            var isIOS = /iPad|iPhone|iPod/.test(userAgent) && !window.MSStream;

            if (isAndroid) {
                document.getElementById('redirect-msg').style.display = 'block';
                // Try to open the app
                window.location.href = appDeepLink;
                
                // Fallback to Play Store
                setTimeout(function() {
                     if (!document.hidden) {
                        window.location.href = playStoreLink;
                    }
                }, 1500);
            } 
            // iOS: Smart Banner handles it.
        }

        window.onload = redirect;
    </script>
</body>
</html> --}}
