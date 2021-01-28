<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;
use App\Repositories\TaskRepository;

class TaskService implements ServiceInterface
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * TaskService constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return TaskRepository
     */
    public function taskRepository(): RepositoryInterface
    {
        return $this->taskRepository;
    }

    /**
     * @param int $paginate
     * @param array $order
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserTasks(int $paginate, array $order = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->taskRepository->getAllByFields([], $paginate, $order);
    }

    /**
     * @param array $field
     * @param null $user_id
     * @param null $id
     * @return \App\Models\Task|bool
     */
    public function saveTask(array $field, $user_id = null, $id = null)
    {
        if ($user_id) {
            $field['user_id'] = $user_id;
        }

        if ($id) {
            return $this->taskRepository->update($id, $field, true);
        }

        return $this->taskRepository->add($field);
    }
}
