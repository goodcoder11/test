<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request, TaskService $taskService)
    {
        if ($request->filled(['sort_field', 'sort_direction']) && in_array($request->get('sort_field'), ['user_name', 'email', 'status'])) {
            $tasks = $taskService->getUserTasks(2, [$request->get('sort_field') => $request->get('sort_direction') == 'desc' ? 'desc' : 'asc']);
        } else {
            $tasks = $taskService->getUserTasks(2);
        }

        $countTasks = $tasks->count();

        $model = $taskService->taskRepository()->model();

        return view('main.index', compact('tasks', 'model', 'countTasks'));
    }

    public function createTask(TaskRequest $taskRequest, TaskService $taskService)
    {
        $fields = $taskRequest->only(['user_name', 'email', 'text']);

        $taskService->saveTask($fields, auth()->id() ?: null);

        return back()->with('message', 'Your task was successfully created.');
    }
}
