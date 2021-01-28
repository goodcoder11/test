<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateTaskStatusRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request, TaskService $taskService)
    {
        if ($request->filled(['sort_field', 'sort_direction']) && in_array($request->get('sort_field'), ['user_name', 'email', 'status'])) {
            $tasks = $taskService->getUserTasks(2, [$request->get('sort_field') => $request->get('sort_direction') == 'desc' ? 'desc' : 'asc']);
        } else {
            $tasks = $taskService->getUserTasks(2);
        }

        $countTasks = $tasks->count();

        $allowCB = true;

        return view('admin.index', compact('tasks', 'countTasks', 'allowCB'));
    }

    public function updateTaskStatus(UpdateTaskStatusRequest $request, TaskService $taskService)
    {
        $success = $taskService->taskRepository()->updateStatus($request->id, $request->status);

        $message = $success && $request->status ? 'отредактировано администратором' : 'не проверено';

        return response()->json(['success' => $success, 'message' => $message], 200);
    }
}
