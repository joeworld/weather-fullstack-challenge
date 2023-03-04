<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        if (Cache::has('users')) {
            $users = Cache::get('users');
        } else {
            $users = User::query()->whereNotNull(['latitude', 'longitude'])->get();
            Cache::put('users', $users, config('app.cache_time'));
        }

        return $users;
    }

    /**
     * @return mixed
     */
    public function get($id)
    {
        $key = 'user-'.$id;
        if (Cache::has($key)) {
            $user = Cache::get($key);
        } else {
            $user = User::find($id);
            Cache::put($key, $user, config('app.cache_time'));
        }

        return $user;
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function paginate($page)
    {
        // TODO: Implement paginate() method.
    }
}
