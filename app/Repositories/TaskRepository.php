<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements RepositoryInterface
{
    /**
     * @var Task
     */
    protected $model;

    /**
     * TaskRepository constructor.
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * @return Task
     */
    public function model(): Task
    {
        return $this->model;
    }

    /**
     * @param int $id
     * @param bool $fail
     * @return Task
     */
    public function get(int $id, bool $fail = false): Task
    {
        return $fail ? $this->model->newQuery()->findOrFail($id) : $this->model->newQuery()->find($id);
    }

    /**
     * @param int $fields
     * @param bool $fail
     * @return Task
     */
    public function getOneByFields(array $fields, bool $fail = false): Task
    {
        $query = $this->model->newQuery()->where($fields);

        return $fail ? $query->firstOrFail() : $this->model->newQuery()->first();
    }

    /**
     * @param array $fields
     * @param int $paginate
     * @param array|null $order
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllByFields(array $fields, int $paginate, array $order = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (!empty($fields)) {
            $query->where($fields);
        }

        if (!empty($order)) {
            $query->orderBy(array_key_first($order), end($order));
        }

        return $query->paginate($paginate);
    }

    /**
     * @param array $fields
     * @return Task
     */
    public function add(array $fields): Task
    {
        return $this->model->newQuery()->create($fields);
    }

    /**
     * @param int $id
     * @param bool $status
     * @param bool $fail
     * @return bool
     */
    public function updateStatus(int $id, bool $status, bool $fail = false): bool
    {
        return $this->update($id, ['status' => $status], $fail);
    }

    /**
     * @param int $id
     * @param array $fields
     * @param bool $fail
     * @return bool
     */
    public function update(int $id, array $fields, $fail = false): bool
    {
        return $this->get($id, $fail)->update($fields);
    }

    /**
     * @param int $id
     * @param bool $fail
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id, bool $fail = false): bool
    {
        return $this->get($id, $fail)->delete();
    }
}
