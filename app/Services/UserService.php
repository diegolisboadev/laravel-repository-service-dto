<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Support\Facades\Hash;
use App\Services\Contracts\IUserService;
use Illuminate\Support\Facades\DB;

class UserService implements IUserService
{

    public function __construct(private IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAllUsers()
    {
        return $this->userRepository->findAll();
    }

    public function findUser(int $id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(UserDTO $userDto)
    {
        DB::transaction(function () use ($userDto) {
            return $this->userRepository->create([
                'name' => $userDto->name,
                'email' => $userDto->email,
                'password' => Hash::make($userDto->password)
            ]);
        });
    }

    public function updateUser(int $id, UserDTO $userDto)
    {
        DB::transaction(function () use ($userDto, $id) {
            return $this->userRepository->update(collect($userDto)->toArray(), $id);
        });
    }

    public function deleteUser(int $id)
    {
        DB::transaction(function () use ($id) {
            return $this->userRepository->delete($id);
        });
    }
}
