<?php

declare(strict_types=1);


namespace App\Services;


use App\Entities\TaskListEntity;
use App\Repositories\TaskListsRepository;

class TaskListsService
{
    public function __construct(private TaskListsRepository $taskListsRepository) {}

    public function createTaskList(string $id, string $name, string $userId): TaskListEntity {
        return $this->taskListsRepository->createTaskList($id, $name, $userId);
    }

    public function getTaskList(string $id, string $userId): TaskListEntity {
        return $this->taskListsRepository->getTaskList($id, $userId);
    }
}
