<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(private Task $task)
    {
    }

    public function all()
    {
        return $this->task->all();
    }

    public function create(array $data)
    {
        return $this->task->create($data);
    }

    public function update(array $data, $id)
    {
        $user = $this->find($id);
        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
    }

    public function find($id)
    {
        return $this->task->findOrFail($id);
    }
}
