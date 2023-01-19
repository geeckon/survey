<?php

namespace App\Repositories;

use App\Models\Answer;

class AnswersRepository
{
    /** @var Answer $model */
    protected $model;

    /**
     * AnswersRepository constructor.
     * @param Answer $model
     */
    public function __construct(Answer $model)
    {
        $this->model = $model;
    }

    /**
     * @return Answer[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return Answer|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return Answer|Answer[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
