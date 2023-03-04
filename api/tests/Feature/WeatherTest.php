<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne();
    }

    public function test_that_weather_is_in_user_response()
    {
        $response = $this->get('/users/'.$this->user->id);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'lat',
                'lon',
                'weather' => [
                    'day',
                    'lat',
                    'lon',
                    'temp',
                    'timezone',
                    'feels_like',
                    'pressure',
                    'clouds',
                    'visibility',
                    'wind_speed',
                    'wind_deg',
                    'weather' => [
                        'icon',
                        'url',
                        'main',
                        'description',
                    ],
                ],
                'weather_for_all_days',
                'created_at',
                'updated_at',
            ],
        ]);

        // Ensure API returned valid data
        $response->assertJsonFragment([
            'lat' => $response->decodeResponseJson()['data']['weather']['lat'],
            'day' => Carbon::today()->format('d, M'),
        ]);

        // Ensure weather data are not empty
        $this->assertNotEmpty($response->decodeResponseJson()['data']['weather']['temp']);
        $this->assertNotEmpty($response->decodeResponseJson()['data']['weather']['feels_like']);
    }

    public function test_weather_for_all_days_in_week_api()
    {
        $response = $this->get('/users/'.$this->user->id.'/all-days');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'lat',
                'lon',
                'weather',
                'weather_for_all_days' => [
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday',
                ],
                'created_at',
                'updated_at',
            ],
        ]);

        // Ensure API returned valid data
        $response->assertJsonFragment([
            'lat' => $response->decodeResponseJson()['data']['weather_for_all_days']['monday']['lat'],
        ]);
    }
}
