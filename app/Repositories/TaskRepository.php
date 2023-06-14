<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{

    public function __construct(protected Task $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getById($id): Task
    {
        return $this->model->findOrFail($id);
    }

    public function create($data): Task
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete($id): bool
    {
        return $this->getById($id)?->delete();
    }
}
