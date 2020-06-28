<?php

namespace App\Observers;

use App\Task;

class TaskObserve
{
    /**
     * Handle the task "created" event.
     *
     * @param \App\Task $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->recordActivity('created_task');
    }

    /**
     * Handle the task "updated" event.
     *
     * @param \App\Task $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $task->recordActivity('deleted_task');
    }
}
