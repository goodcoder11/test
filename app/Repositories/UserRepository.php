<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements RepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @return User
     */
    public function model(): User
    {
        return $this->model;
    }

    /**
     * @param array $fields
     * @return bool
     */
    public function has(array $fields): bool
    {
        return $this->model->newQuery()->where($fields)->exists();
    }

    /**
     * @param array $fields
     * @param bool $fail
     * @return User
     */
    public function get(array $fields, bool $fail = false): User
    {
        $query = $this->model->newQuery()->where($fields);

        return $fail ? $query->firstOrFail() : $query->first();
    }

    /**
     * @param array $fields
     * @return User
     */
    public function add(array $fields): User
    {
        return $this->model->newQuery()->create($fields);
    }

    /**
     * @param array $fieldsToFind
     * @param array $fields
     * @param bool $fail
     * @return User
     */
    public function update(array $fieldsToFind, array $fields, $fail = false): User
    {
        $user = $this->get($fieldsToFind, $fail);
        $user->update($fields);
        return $user;
    }

    /**
     * @param array $fieldsToFind
     * @param bool $fail
     * @return bool
     * @throws \Exception
     */
    public function delete(array $fieldsToFind, bool $fail = false): bool
    {
        return $this->get($fieldsToFind, $fail)->delete();
    }
}
