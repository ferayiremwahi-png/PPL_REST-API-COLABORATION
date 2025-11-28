<?php
$apiKey = "861d250abaad4dbea3f185128252611";
$weatherData = null;

if (isset($_GET['city'])) {
    $city = urlencode($_GET['city']);
    $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city&aqi=no";

    $response = file_get_contents($url);
    if ($response) {
        $weatherData = json_decode($response, true);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WeatherNow - REST Client Cuaca</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #6EA6FF, #5F82E8);
            min-height: 100vh;
            padding: 20px;

            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ===== HEADER TANPA BOX ===== */
        .header-wrapper {
            align-self: flex-start;
            margin-left: 20px;
            margin-top: 10px;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.20);
        }

        .header-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.9);
            margin-top: -5px;
            margin-left: 38px; /* rata dengan teks setelah ikon */
        }

        .divider {
            width: 360px;
            height: 3px;
            background: rgba(255,255,255,0.4);
            border-radius: 3px;
            margin-top: 6px;
            margin-left: 38px;
        }

        /* ===== SEARCH BOX ===== */
        .search-container {
            background: rgba(255, 255, 255, 0.3);
            width: 65%;
            margin-top: 50px;
            padding: 25px;
            display: flex;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            backdrop-filter: blur(10px);
            justify-content: center;
        }

        .search-container input {
            width: 80%;
            padding: 15px;
            font-size: 16px;
            border-radius: 12px;
            border: none;
            outline: none;
            margin-right: 15px;
        }

        .search-container button {
            padding: 15px 25px;
            border: none;
            background: #0A1B51;
            color: white;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .search-container button:hover {
            background: #132b7c;
        }

        /* ===== CARD CUACA ===== */
        .weather-card {
            background: rgba(255, 255, 255, 0.25);
            margin-top: 50px;
            padding: 40px;
            width: 55%;
            border-radius: 25px;
            text-align: center;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .weather-card img {
            width: 80px;
        }

        .weather-title {
            font-size: 28px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .detail {
            font-size: 18px;
            text-align: left;
            margin-left: 25%;
        }

        .detail span {
            font-weight: 600;
        }
    </style>
</head>
<body>

    <!-- HEADER TANPA BOX -->
    <div class="header-wrapper">
        <div class="header-title">🌥 WeatherNow</div>
        <div class="header-subtitle">Cek cuaca kota di seluruh dunia secara real-time</div>
        <div class="divider"></div>
    </div>

    <!-- SEARCH -->
    <form class="search-container" method="GET">
        <input type="text" name="city" placeholder="Cari kota..."
            value="<?= isset($_GET['city']) ? htmlspecialchars($_GET['city']) : '' ?>" required>
        <button type="submit">Cari</button>
    </form>

    <!-- HASIL CUACA -->
    <?php if ($weatherData) : ?>
        <div class="weather-card">
            <img src="https:<?= $weatherData['current']['condition']['icon']; ?>" alt="icon">

            <div class="weather-title">
                <?= $weatherData['location']['name']; ?>,
                <?= $weatherData['location']['country']; ?>
            </div>

            <div class="detail">
                🌡 <span>Suhu:</span> <?= $weatherData['current']['temp_c']; ?>°C <br>
                ☁ <span>Kondisi:</span> <?= $weatherData['current']['condition']['text']; ?> <br>
                🌬 <span>Angin:</span> <?= $weatherData['current']['wind_kph']; ?> km/jam <br>
                💧 <span>Kelembapan:</span> <?= $weatherData['current']['humidity']; ?>%
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
