<?php

declare(strict_types=1);


namespace App\Http\Controllers;


use App\Http\Requests\CreateTaskListRequest;
use App\Services\TaskListsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskListsController extends Controller
{
    public function __construct(private TaskListsService $taskListsService) {}

    public function createTask(CreateTaskListRequest $request, string $id): Response {
        $this->taskListsService->createTaskList(
            $id,
            $request->input('name'),
            (string) $request->user()->id
        );

        return response()->noContent(201);
    }

    public function getAllTaskLists() {
        return $this->taskListsService->getAllTaskLists();
    }

    public function getTaskList(Request $request, string $id): JsonResponse {
        $taskList = $this->taskListsService->getTaskList($id, $request->user()->id);
        return response()->json($taskList);
    }
}
