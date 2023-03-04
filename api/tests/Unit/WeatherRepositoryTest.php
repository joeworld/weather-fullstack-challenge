<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\WeatherRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WeatherRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private WeatherRepository $weatherRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne();
        $this->weatherRepo = new WeatherRepository();
    }

    public function test_user_can_retrieve_weather_report_for_current_day()
    {
        $day = Carbon::today();
        $lat = $this->user->latitude;
        $lon = $this->user->longitude;

        $data = $this->weatherRepo->getWeather($lat, $lon, $day);
        $this->assertArrayHasKey('temp', $data);
    }

    public function test_users_caching_works()
    {
        $day = Carbon::today();
        $lat = $this->user->latitude;
        $lon = $this->user->longitude;
        $key = $day.'-'.$lat.'-'.$lon;

        $data = $this->weatherRepo->getWeather($lat, $lon, $day);
        $this->assertNotEmpty(Cache::get($key));

        $cachedMap = $this->weatherRepo->mapWeather($day, Cache::get($key));
        $this->assertEquals($data['temp'], $cachedMap['temp']);
    }

    public function test_map_function_does_not_fail_with_empty_data()
    {
        $cachedMap = $this->weatherRepo->mapWeather(Carbon::today());
        $this->assertIsArray($cachedMap);
    }

    public function test_user_can_retrieve_all_weather_reports_for_the_week()
    {
        $lat = $this->user->latitude;
        $lon = $this->user->longitude;

        $week = $this->weatherRepo->getWeatherForAllDaysInWeek($lat, $lon);
        $this->assertIsArray($week);

        $this->assertArrayHasKey('monday', $week);

        // Check that all days in the week was stored in cache including current day
        $day = Carbon::today();
        $key = $day.'-'.$lat.'-'.$lon;
        $this->assertNotEmpty(Cache::get($key));
    }
}
