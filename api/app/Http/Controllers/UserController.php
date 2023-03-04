<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Repositories\WeatherRepository;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepo
     * @param WeatherRepository $weatherRepository
     */
    public function __construct(private UserRepository $userRepo, private WeatherRepository $weatherRepository)
    {
    }

    /**
     * @return mixed
     */
    public function index()
    {
//        if (env('QUEUE_CONNECTION') === 'redis') {
//            WeatherJob::dispatch(); // Sync all data to redis for swift access when requested
//        }

        return UserResource::collection($this->userRepo->all());
    }

    /**
     * @param $id
     * @return UserResource|\never
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($id)
    {
        $user = $this->userRepo->get($id);
        if ($user) {
            $user->weather = $this->weatherRepository->getWeather($user->latitude, $user->longitude, Carbon::today());

            return new UserResource($user);
        }

        return abort(404);
    }

    /**
     * @param $id
     * @return UserResource|\never
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllDaysInWeekWeather($id)
    {
        $user = $this->userRepo->get($id);
        if ($user) {
            $user->weather_for_all_days = $this->weatherRepository->getWeatherForAllDaysInWeek($user->latitude, $user->longitude);

            return new UserResource($user);
        }

        return abort(404);
    }
}
