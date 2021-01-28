<?php

namespace App\Repositories;

use App\Models\UserRoles;

class UserRolesRepository implements RepositoryInterface
{
    /**
     * @var UserRoles
     */
    protected $model;

    /**
     * UserRolesRepository constructor.
     * @param UserRoles $model
     */
    public function __construct(UserRoles $model)
    {
        $this->model = $model;
    }

    /**
     * @return UserRoles
     */
    public function model(): UserRoles
    {
        return $this->model;
    }

    /**
     * @param int $user_id
     * @param int $role_id
     * @return UserRoles
     */
    public function getRole(int $user_id, int $role_id): UserRoles
    {
        return $this->model->newQuery()->where(['user_id' => $user_id, 'role_id' => $role_id])->first();
    }

    /**
     * @param int $user_id
     * @param int $role_id
     * @return bool
     */
    public function has(int $user_id, int $role_id): bool
    {
        return $this->model->newQuery()->where(['user_id' => $user_id, 'role_id' => $role_id])->exists();
    }

    public function addUserRole(int $user_id, int $role_id): UserRoles
    {
        return $this->model->newQuery()->create(['user_id' => $user_id, 'role_id' => $role_id]);
    }
}
