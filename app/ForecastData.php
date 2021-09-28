<?php

namespace App;

class ForecastData
{
    private array $forecastData;

    public function __construct(array $forecastData)
    {
        $this->forecastData = $forecastData;
    }

    public function getCity(): string
    {
        return $this->forecastData['location']['name'];
    }

    public function getCountry(): string
    {
        return $this->forecastData['location']['country'];
    }

    public function getLocalTime(): string
    {
        return $this->forecastData['location']['localtime'];
    }

    public function getCurrentTemp(): float
    {
        return round($this->forecastData['current']['temp_c']);
    }

    public function getCurrentCondition(): string
    {
        return $this->forecastData['current']['condition']['text'];
    }

    public function getCurrentWindSpeed(): float
    {
        return round($this->forecastData['current']['wind_kph']);
    }

    public function getCurrentHumidity(): int
    {
        return $this->forecastData['current']['humidity'];
    }

    public function getCurrentConditionIcon(): string
    {
        return $this->forecastData['current']['condition']['icon'];
    }

    public function getCurrentUV(): float
    {
        return $this->forecastData['current']['uv'];
    }

    public function getAllDays(): array
    {
        return $this->forecastData['forecast']['forecastday'];
    }

    public function getDailyMin(int $key): float
    {
        return round($this->forecastData['forecast']['forecastday'][$key]['day']['mintemp_c']);
    }

    public function getDailyMax(int $key): float
    {
        return round($this->forecastData['forecast']['forecastday'][$key]['day']['maxtemp_c']);
    }

    public function getDailyAverageTemp(int $key): float
    {
        return round($this->forecastData['forecast']['forecastday'][$key]['day']['avgtemp_c']);
    }

    public function getWindSpeed(int $key): float
    {
        return round($this->forecastData['forecast']['forecastday'][$key]['day']['maxwind_kph']);
    }

    public function getAverageHumidity(int $key): int
    {
        return round($this->forecastData['forecast']['forecastday'][$key]['day']['avghumidity']);
    }

    public function getDailyUv(int $key): int
    {
        return $this->forecastData['forecast']['forecastday'][$key]['day']['uv'];
    }

    public function getDailyIcon(int $key): string
    {
        return $this->forecastData['forecast']['forecastday'][$key]['day']['condition']['icon'];
    }

    public function getDailyCondition(int $key): string
    {
        return $this->forecastData['forecast']['forecastday'][$key]['day']['condition']['text'];
    }

}