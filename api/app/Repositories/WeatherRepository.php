<?php

namespace App\Repositories;

use App\Contracts\WeatherRepositoryInterface;
use App\Services\OpenWeatherService;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeatherRepository implements WeatherRepositoryInterface
{
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $key;

    /**
     * WeatherRepository constructor.
     */
    public function __construct()
    {
        $this->key = config('services.openweather.id');
    }

    /**
     * @param float $lat
     * @param float $lon
     * @param CarbonInterface $day
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeather(float $lat, float $lon, CarbonInterface $day)
    {
        $date = strtotime($day); //Convert to Unix

        $key = $day.'-'.$lat.'-'.$lon;
        $weather = Cache::get($key);

        if ($weather) {
            return $this->mapWeather($day, $weather);
        } else {
            try {
                $weather = (new OpenWeatherService($this->key))
                    ->setLat($lat)
                    ->setLon($lon)
                    ->setDt($date)
                    ->makeRequest();

                Cache::put($key, $weather, config('app.cache_time'));

                return $this->mapWeather($day, $weather);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());

                return $this->mapWeather($day);
            }
        }
    }

    /**
     * @param float $lat
     * @param float $lon
     * @param CarbonInterface $day
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeatherForAllDaysInWeek(float $lat, float $lon)
    {
        $monday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek());
        $tuesday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek()->addDays(1));
        $wednesday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek()->addDays(2));
        $thursday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek()->addDays(3));
        $friday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek()->addDays(4));
        $saturday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek()->addDays(5));
        $sunday = $this->getWeather($lat, $lon, Carbon::today()->startOfWeek()->addDays(6));

        return [
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'sunday' => $sunday,
        ];
    }

    /**
     * @param CarbonInterface $day
     * @param array $weather
     * @return array
     */
    public function mapWeather(CarbonInterface $day, array $weather = []): array
    {
        if (isset($weather['data'])) {
            $iconDetail = $weather['data'][0]['weather'][0];
            $data = $weather['data'][0];
        } else {
            $iconDetail = null;
            $data = null;
        }

        return [
            'day' => $day->format('d, M'),
            'lat' => $weather['lat'] ?? null,
            'lon' => $weather['lon'] ?? null,
            'timezone' => $weather['timezone'] ?? null,
            'temp' => $data['temp'] ?? null,
            'feels_like' => $data['feels_like'] ?? null,
            'pressure' => $data['pressure'] ?? null,
            'clouds' => $data['clouds'] ?? null,
            'visibility' => $data['visibility'] ?? null,
            'wind_speed' => $data['wind_speed'] ?? null,
            'wind_deg' => $data['wind_deg'] ?? null,
            'weather' => $this->getIcon($iconDetail ?? null),
        ];
    }

    /**
     * @param array|null $iconDetail
     * @return array
     */
    private function getIcon(?array $iconDetail = null): array
    {
        $icon = $iconDetail['icon'] ?? null;

        return [
            'icon' => $icon,
            'url' => 'https://openweathermap.org/img/wn/'.$icon.'@2x.png',
            'main' => $iconDetail['main'] ?? null,
            'description' => $iconDetail['description'] ?? null,
        ];
    }
}
