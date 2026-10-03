<?php

namespace App\Controllers;

class Weather extends BaseController
{
    public function index()
    {
        return view('layouts/header', ['title' => 'Weather'])
            . view('weather')
            . view('layouts/footer');
    }

    public function forecast()
    {
        $lat = filter_var($this->request->getGet('lat'), FILTER_VALIDATE_FLOAT);
        $lon = filter_var($this->request->getGet('lon'), FILTER_VALIDATE_FLOAT);
        if ($lat === false || $lon === false || $lat < -90 || $lat > 90 || $lon < -180 || $lon > 180) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Valid latitude and longitude are required.']);
        }
        $url = 'https://api.open-meteo.com/v1/forecast?latitude=' . rawurlencode((string)$lat)
            . '&longitude=' . rawurlencode((string)$lon)
            . '&current=temperature_2m,relative_humidity_2m,apparent_temperature,precipitation,wind_speed_10m,weather_code'
            . '&daily=precipitation_probability_max&timezone=auto&forecast_days=1';
        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 8, CURLOPT_CONNECTTIMEOUT => 4]);
        $body = curl_exec($ch);
        $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($body === false || $status !== 200) {
            return $this->response->setStatusCode(502)->setJSON(['error' => 'Weather service is temporarily unavailable.']);
        }
        return $this->response->setJSON(json_decode($body, true) ?? ['error' => 'Invalid weather response.']);
    }
}
