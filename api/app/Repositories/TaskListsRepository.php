<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\TaskList;

class TaskListsRepository
{
    public function __construct() {
    }

    public function createTaskList(string $id, string $name, string $userId) {
        $taskList = new TaskList([
            'id' => $id,
            'name' => $name
        ]);
        $taskList->owner()->associate($userId);
        $taskList->save();

        return $taskList->toEntity();
    }

    public function getTaskList(string $id, string $userId) {
        return TaskList::where('id', $id)
            ->where('owner_id', $userId)
            ->firstOrFail()
            ->toEntity();
    }

    public function getAllTaskListsByUserId(string $userId) {
        return TaskList::where('owner_id', $userId)->all()->map(fn($taskList) => $taskList->toEntity());
    }
}
