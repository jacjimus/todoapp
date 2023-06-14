<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(protected TaskRepository $taskRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskRepository->getAll();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $safeRequest = $request->safe();
        $task = $this->taskRepository->create($safeRequest->all());

        return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $task = $this->taskRepository->getById($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, $id): JsonResponse
    {
        $safeRequest = $request->safe();
        $this->taskRepository->update($id, $safeRequest->all());

        return response()->json(['success' => true], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->taskRepository->delete($id);

        return response()->json(['success' => true], 201);
    }
}
