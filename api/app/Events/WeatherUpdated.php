<?php

namespace App\Events;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\WeatherRepository;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WeatherUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var UserResource
     */
    public $user;

    /**
     * @var mixed
     */
    private $userId;

    /**
     * Create a new event instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->userId = $user->id;
        $weather = new WeatherRepository();
        $user->weather =  $weather->getWeather($user->latitude, $user->longitude, Carbon::today()); // Get cached data
        $this->user = new UserResource($user);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('user.'.$this->userId),
        ];
    }
}
