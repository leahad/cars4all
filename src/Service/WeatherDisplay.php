<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherDisplay
{
    // possible future improvement: add geolocation
    public const PARIS_LATITUDE = 48.85;
    public const PARIS_LONGITUDE = 2.35;

    public function __construct(private HttpClientInterface $client) {}

    public function getWeatherCodes()
    {
        $response = $this->client->request('GET', 'https://gist.githubusercontent.com/stellasphere/9490c195ed2b53c707087c8c2db4ec0c/raw/7f2d37310ac5d5c309fd9d2f4dd98cc837c28237/descriptions.json');

        $weatherCodes = $response->toArray();
    
        return $weatherCodes;
    }

    public function getWeatherPerHour()
    {
        $response = $this->client->request('GET', 'https://api.open-meteo.com/v1/forecast?latitude=' . self::PARIS_LATITUDE . '&longitude=' . self::PARIS_LONGITUDE . '&hourly=temperature_2m,weathercode&current_weather=true&timezone=auto');

        $weatherInfo = $response->toArray();

        $weatherCodes = $this->getWeatherCodes();

        foreach($weatherCodes as $index => $weatherCode) {
            if ($weatherInfo['current_weather']['weathercode'] === $index) {
                $weather = $weatherCode['day']['description'];
                return 'at ' .  date('H', strtotime($weatherInfo['current_weather']['time'])) . ':00[Paris time], the weather is ' . strtolower($weather) . ' and temperature is ' . $weatherInfo['current_weather']['temperature'] . '°C';
            }
        }
    }
}
