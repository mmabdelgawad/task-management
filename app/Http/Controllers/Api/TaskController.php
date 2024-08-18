<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Auth\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\Task\TaskResource;
use App\Interfaces\Repositories\TaskRepositoryInterface;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskRepositoryInterface $taskRepository)
    {
        // TODO: return user's tasks only
        return TaskResource::collection($taskRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, TaskRepositoryInterface $taskRepository)
    {
        $task = $taskRepository->create($request->validated());

        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, TaskRepositoryInterface $taskRepository)
    {
        // TODO: view my own tasks only
        return TaskResource::make($taskRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id, TaskRepositoryInterface $taskRepository)
    {
        $task = $taskRepository->update($request->validated(), $id);

        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, TaskRepositoryInterface $taskRepository)
    {
        // TODO: move to middleware instead of inline check
        if (auth()->user()->cannot('delete task')) {
            throw AuthException::unauthorized();
        }

        $taskRepository->delete($id);

        return response()->noContent();
    }
}
