<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherDisplay
{
    public function __construct(private HttpClientInterface $client) {}

    public function weatherCodes()
    {
        $response = $this->client->request('GET', 'https://gist.githubusercontent.com/stellasphere/9490c195ed2b53c707087c8c2db4ec0c/raw/7f2d37310ac5d5c309fd9d2f4dd98cc837c28237/descriptions.json');

        $weatherCodes = $response->getContent();
        $weatherCodes = $response->toArray();
    
        return $weatherCodes;

    }

    public function weatherPerHour()
    {
        $response = $this->client->request('GET', 'https://api.open-meteo.com/v1/forecast?latitude=48.85&longitude=2.35&hourly=temperature_2m,weathercode&current_weather=true&timezone=auto');

        $weatherInfo = $response->getContent();
        $weatherInfo = $response->toArray();

        $temperature = $weatherInfo['current_weather']['temperature'];
        $time = $weatherInfo['current_weather']['time'];

        $weatherCodes = $this->weatherCodes();

        foreach($weatherCodes as $index => $weatherCode) {
            if ($weatherInfo['current_weather']['weathercode'] == $index) {
                $weather = $weatherCode['day']['description'];
                return 'at ' .  date('H', strtotime($time)) . ':00[Paris time], the weather is ' . strtolower($weather) . ' and temperature is ' . $temperature . '°C';
            }
        }
    }

}
