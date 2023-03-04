<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $users;

    private UserRepository $userRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory(20)->create();
        $this->userRepo = new UserRepository();
    }

    public function test_users_caching_works()
    {
        $this->userRepo->all();
        $this->assertNotEmpty(Cache::get('users'));

        $this->userRepo->get($this->users[0]['id']);
        $this->assertNotEmpty(Cache::get('user-'.$this->users[0]['id']));
    }

    public function test_users_collection_works()
    {
        $this->assertCount(20, $this->userRepo->all()); // Count collection
    }

    public function test_users_get_work()
    {
        $this->assertSame($this->users[0]['name'], $this->userRepo->get($this->users[0]['id'])?->name);
    }
}
