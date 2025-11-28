<?php
/**
 * CONFIG UNTUK RESTClient Cuaca (WeatherAPI)
 * -------------------------------------------------
 * API KEY : WeatherAPI
 */

$weather_api_key = "861d250abaad4dbea3f185128252611";

/**
 * HTTP GET Request menggunakan cURL
 */
function http_request_get($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);

    $result = curl_exec($curl);

    if (curl_errno($curl)) {
        echo "CURL ERROR: " . curl_error($curl);
    }

    curl_close($curl);
    return $result;
}
