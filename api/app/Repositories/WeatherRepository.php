<?php

namespace App\Repositories;

use App\Contracts\WeatherRepositoryInterface;
use Carbon\CarbonInterface;

class WeatherRepository implements WeatherRepositoryInterface
{

    public function getWeather(float $lan, float $lon, CarbonInterface $day)
    {
        // TODO: Implement getWeather() method.
    }
}
