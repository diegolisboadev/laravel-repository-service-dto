<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function create(array $fields)
    {
        return $this->model->create($fields);
    }

    public function update(array $fields, int $id)
    {
        $model = $this->model->findOrFail($id);
        $model->update($fields);
        return $model;
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete(int $id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return $model;
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
