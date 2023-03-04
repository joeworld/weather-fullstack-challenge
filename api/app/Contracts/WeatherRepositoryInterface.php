<?php

namespace App\Contracts;

use Carbon\CarbonInterface;

interface WeatherRepositoryInterface
{
    public function getWeather(float $lan, float $lon, CarbonInterface $day);
}
