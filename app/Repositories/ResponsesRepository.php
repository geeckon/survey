<?php

namespace App\Repositories;

use App\Models\Response;

class ResponsesRepository
{
    /** @var Response $model */
    protected $model;

    /**
     * ResponsesRepository constructor.
     * @param Response $model
     */
    public function __construct(Response $model)
    {
        $this->model = $model;
    }

    /**
     * @return Response[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return Response|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return Response|\Illuminate\Database\Eloquent\Model
     */
    public function createMultiple(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param int $id
     * @return Response|Response[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
