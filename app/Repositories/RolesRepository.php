<?php

namespace App\Repositories;

use App\Models\Role;

class RolesRepository implements RepositoryInterface
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * RolesRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @return Role
     */
    public function model(): Role
    {
        return $this->model;
    }

    /**
     * @param string $name
     * @return Role
     */
    public function getRole(string $name): Role
    {
        return $this->model->newQuery()->where('name', $name)->first();
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->model->newQuery()->where('name', $name)->exists();
    }

    /**
     * @param $name
     * @return Role
     */
    public function addRole($name): Role
    {
        return $this->model->newQuery()->create(['name' => $name]);
    }
}
