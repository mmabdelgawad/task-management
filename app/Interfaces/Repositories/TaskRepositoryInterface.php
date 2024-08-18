<?php

namespace App\Interfaces\Repositories;

interface TaskRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find(string $id);

    public function update(array $data, string $id);

    public function delete(string $id);
}
