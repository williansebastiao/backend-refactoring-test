<?php

namespace App\repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository
{

    /**
     * @var User
     */
    protected User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->user->orderBy('id', 'desc')->get();
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return $this->user->create($data);
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->user->findOrFail($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User
    {
        $user = $this->findById($id);
        $this->user->find($id)->update($data);
        return $user;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $user = $this->user->find($id);
        if (is_null($user)) {
            throw new NotFoundHttpException('User not found');
        }
        $user->delete();
        return true;

    }

}
