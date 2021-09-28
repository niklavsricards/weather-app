<?php

namespace App;

class Request
{
    private string $apiKey;
    private string $location;
    private int $days;

    public function __construct(string $apiKey, string $location, int $days)
    {
        $this->apiKey = $apiKey;
        $this->location = $location;
        $this->days = $days;
    }

    public function response(): array
    {
        $response = \Requests::get("http://api.weatherapi.com/v1/forecast.json?key={$this->apiKey}&q={$this->location}&days={$this->days}&aqi=no&alerts=no");
        return json_decode($response->body, true);
    }
}