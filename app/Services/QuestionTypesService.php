<?php

namespace App\Services;

use App\Models\QuestionType;
use App\Repositories\QuestionTypesRepository;

class QuestionTypesService
{
    /** @var QuestionTypesRepository */
    private $questionTypesRepository;

    /**
     * QuestionTypesService constructor.
     * @param QuestionTypesRepository $questionTypesRepository
     */
    public function __construct(QuestionTypesRepository $questionTypesRepository)
    {
        $this->questionTypesRepository = $questionTypesRepository;
    }

    /**
     * @return QuestionType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->questionTypesRepository->getAll();
    }

    /**
     * @param array $data
     * @return QuestionType|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->questionTypesRepository->create($data);
    }

    /**
     * @param int $id
     * @return QuestionType|QuestionType[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->questionTypesRepository->findOrFail($id);
    }

    /**
     * @param array $filter
     * @return QuestionType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBy(array $filter)
    {
        return $this->questionTypesRepository->getBy($filter);
    }
}
