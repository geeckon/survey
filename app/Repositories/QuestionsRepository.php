<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionsRepository
{
    /** @var Question $model */
    protected $model;

    /**
     * QuestionsRepository constructor.
     * @param Question $model
     */
    public function __construct(Question $model)
    {
        $this->model = $model;
    }

    /**
     * @return Question[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return Question|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return Question|Question[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $filter
     * @return Question[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBy(array $filter)
    {
        return $this->model->where($filter)->get();
    }
}
