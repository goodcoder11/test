<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RepositoryInterface;
use App\Repositories\RolesRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRolesRepository;
use Illuminate\Support\Facades\Hash;

class UserService implements ServiceInterface
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserRolesRepository
     */
    protected $userRolesRepository;

    /**
     * @var RolesRepository
     */
    protected $rolesRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param UserRolesRepository $userRolesRepository
     */
    public function __construct(
        UserRepository $userRepository,
        UserRolesRepository $userRolesRepository,
        RolesRepository $rolesRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userRolesRepository = $userRolesRepository;
        $this->rolesRepository = $rolesRepository;
    }

    /**
     * @return UserRepository
     */
    public function userRepository(): RepositoryInterface
    {
        return $this->userRepository;
    }

    /**
     * @return RepositoryInterface
     */
    public function userRolesRepository(): RepositoryInterface
    {
        return $this->userRolesRepository;
    }

    /**
     * @param int $user_id
     * @param string $name
     * @return bool
     */
    public function hasRole(int $user_id, string $name): bool
    {
        $role = $this->rolesRepository->getRole($name);

        if ($role && $this->userRolesRepository->has($user_id, $role->id) == true) {
            return true;
        }

        return false;
    }

    /**
     * @param int $user_id
     * @param string $name
     * @return bool
     */
    public function addRole(int $user_id, string $name): bool
    {
        if ($this->rolesRepository->has($name) === false) {
            $role = $this->rolesRepository->addRole($name);

            if ($this->userRolesRepository->has($user_id, $role->id) == false) {
                $this->userRolesRepository->addUserRole($user_id, $role->id);

                return true;
            }
        }

        return false;
    }

    /**
     * @param array $fields
     * @param array $fieldsToFind
     * @return User
     */
    public function saveUser(array $fields, array $fieldsToFind = []): User
    {
        if (isset($fields['password'])) {
            $fields['password'] = Hash::make($fields['password']);
        }

        if (!empty($fieldsToFind) && $this->userRepository->has($fieldsToFind)) {
            return $this->userRepository->update($fieldsToFind, $fields, true);
        }

        return $this->userRepository->add($fields);
    }
}
