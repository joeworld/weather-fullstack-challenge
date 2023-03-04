<?php

namespace App\Jobs;

use App\Events\WeatherUpdated;
use App\Repositories\UserRepository;
use App\Repositories\WeatherRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UserRepository $userRepository;

    private WeatherRepository $weatherRepository;

    /**
     * WeatherJob constructor.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->userRepository = new UserRepository();
        $this->weatherRepository = new WeatherRepository();

        foreach ($this->userRepository->all() as $user) {
            // Sync weather reports for the week to cache
            $this->weatherRepository->getWeatherForAllDaysInWeek($user->latitude, $user->longitude);
            event(new WeatherUpdated($user));
        }
    }
}
