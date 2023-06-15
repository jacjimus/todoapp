<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * @param Task $task
     */
    public function creating(Task $task): void
    {
        $task->user_id = auth()->id();
    }
}
