<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function get($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function paginate($page);
}
