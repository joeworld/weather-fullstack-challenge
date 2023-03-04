<?php

namespace Tests\Unit;

use App\Services\OpenWeatherService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OpenWeatherServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    private $lat = '33.44';

    /**
     * @var string
     */
    private $lon = '-94.04';

    /**
     * @var false|int|null
     */
    private $dt = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dt = strtotime(Carbon::today());
    }

    public function test_weather_service_works()
    {
        $result = (new OpenWeatherService(config('services.openweather.id')))
            ->setLat($this->lat)
            ->setLon($this->lon)
            ->setDt($this->dt)
            ->makeRequest();

        // keys must be present
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('weather', $result['data'][0]);
        $this->assertArrayHasKey('icon', $result['data'][0]['weather'][0]);

        // Temp should not be empty
        $this->assertNotEmpty($result['data'][0]['temp']);
    }

    public function test_weather_service_does_not_work_with_wrong_key()
    {
        try {
            (new OpenWeatherService('HERO'))
                ->setLat($this->lat)
                ->setLon($this->lon)
                ->setDt($this->dt)
                ->makeRequest();
        } catch (GuzzleException $e) {
            $this->assertSame(401, $e->getCode());
        }
    }

    public function test_weather_service_fails_without_coord()
    {
        try {
            (new OpenWeatherService(config('services.openweather.id')))
                ->setDt($this->dt)
                ->makeRequest();
        } catch (\Exception $e) {
            $this->assertSame(400, $e->getCode());
        }
    }
}
