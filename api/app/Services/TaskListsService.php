<?php

declare(strict_types=1);


namespace App\Services;


use App\Entities\TaskListEntity;
use App\Repositories\TaskListsRepository;
use Illuminate\Support\Facades\Cache;

class TaskListsService
{
    public function __construct(private TaskListsRepository $taskListsRepository) {}

    public function createTaskList(string $id, string $name, string $userId): TaskListEntity {
        $taskList = $this->taskListsRepository->createTaskList($id, $name, $userId);
        Cache::put("user_{$userId}_task_list_${id}", $taskList, 60);
        return $taskList;
    }

    public function getTaskList(string $id, string $userId): TaskListEntity {
        $taskList = Cache::get("user_{$userId}_task_list_${id}");
        if (!$taskList) {
            $taskList = $this->taskListsRepository->getTaskList($id, $userId);
            Cache::put("user_{$userId}_task_list_${id}", $taskList, 60);
        }
        return $taskList;
    }

    /**
     * @return TaskListEntity[]
     */
    public function getAllTaskLists(string $userId): array {
        return $this->taskListsRepository->getAllTaskListsByUserId($userId);
    }
}
