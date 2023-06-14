<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{

    public function __construct(protected User $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getById($id): User
    {
        return $this->model->findOrFail($id);
    }

    public function create($data): User
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete($id): bool
    {
        return $this->getById($id)->delete();
    }
}
