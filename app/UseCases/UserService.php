<?php

namespace App\UseCases;

use App\Models\User;
use App\repositories\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param array $data
     * @return \App\Models\User
     */
    public function store(array $data): User
    {
        return $this->userRepository->store($data);
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User
    {
        return $this->userRepository->update($id, $data);
    }

    public function destroy(int $id): bool
    {
        return $this->userRepository->destroy($id);
    }

}
