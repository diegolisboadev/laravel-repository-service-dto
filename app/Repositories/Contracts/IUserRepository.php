<?php

namespace App\Repositories\Contracts;

interface IUserRepository
{
    public function findAll();
    public function create(array $fields);
    public function findById(int $id);
    public function update(array $fields, int $id);
    public function delete(int $id);
}
