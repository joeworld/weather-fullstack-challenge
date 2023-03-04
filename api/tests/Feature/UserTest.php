<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $users;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory(20)->create();
    }

    public function test_users_api_works()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function test_users_api_is_well_structured()
    {
        $response = $this->get('/users');

        // Count is 20
        $response->assertJsonCount($this->users->count(), 'data.*');

        // Check structure
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'lat',
                    'lon',
                    'weather',
                    'weather_for_all_days',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_user_single_api()
    {
        $response = $this->get('/users/'.$this->users[0]['id']);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'lat',
                'lon',
                'weather',
                'weather_for_all_days',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_single_api_returns_404_when_id_is_incorrect()
    {
        $response = $this->get('/users/hero');
        $response->assertStatus(404);
    }
}
