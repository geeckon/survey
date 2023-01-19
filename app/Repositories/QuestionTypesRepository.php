<?php

namespace App\Repositories;

use App\Models\QuestionType;

class QuestionTypesRepository
{
    /** @var QuestionType $model */
    protected $model;

    /**
     * QuestionsRepository constructor.
     * @param QuestionType $model
     */
    public function __construct(QuestionType $model)
    {
        $this->model = $model;
    }

    /**
     * @return QuestionType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return QuestionType|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return QuestionType|QuestionType[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $filter
     * @return QuestionType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBy(array $filter)
    {
        return $this->model->where($filter)->get();
    }
}
