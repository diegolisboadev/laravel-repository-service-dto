<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;

class UserRepository extends AbstractRepository implements IUserRepository
{
    protected $model = User::class;
}
