<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function __construct(protected TaskRepository $taskRepository)
    {
    }

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Task::class);
        $tasks = $this->taskRepository->getAll();
        return Inertia::render('Dashboard', compact('tasks'));
    }

    public function user_tasks(Request $request)
    {
        $tasks = $request->user()->tasks;

        return TaskResource::collection($tasks);
    }

    public function create(): Response
    {
        return Inertia::render('Task/CreateTask');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        $safeRequest = $request->safe();
        $this->taskRepository->create($safeRequest->all());

        return redirect()->route('tasks.index')->with('message', 'Task created successfully');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit($id): Response
    {
        $task = $this->taskRepository->getById($id);

        $this->authorize('view', $task);

        return Inertia::render('Task/EditTask', compact('task'));
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show($id): Response
    {
        $task = $this->taskRepository->getById($id);
        $this->authorize('view', $task);
        return Inertia::render('Task/ViewTask', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(TaskRequest $request, $id): RedirectResponse
    {
        $task = $this->taskRepository->getById($id);
        $this->authorize('update', $task);
        $safeRequest = $request->safe();

        $task->update($safeRequest->all());

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy($id): RedirectResponse
    {
        $task = $this->taskRepository->getById($id);
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully');
    }
}
