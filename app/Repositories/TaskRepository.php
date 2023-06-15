<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{

    public function __construct(protected Task $model)
    {
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return auth()->user()->tasks;
    }

    /**
     * @param $id
     * @return Task
     */
    public function getById($id): Task
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $data
     * @return Task
     */
    public function create($data): Task
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update($id, $data): bool
    {
        return $this->getById($id)->update($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->getById($id)?->delete();
    }
}
