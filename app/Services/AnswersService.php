<?php

namespace App\Services;

use App\Models\Answer;
use App\Repositories\AnswersRepository;

class AnswersService
{
    /** @var AnswersRepository */
    private $answersRepository;

    /**
     * AnswersService constructor.
     * @param AnswersRepository $answersRepository
     */
    public function __construct(AnswersRepository $answersRepository)
    {
        $this->answersRepository = $answersRepository;
    }

    /**
     * @return Answer[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->answersRepository->getAll();
    }

    /**
     * @param array $data
     * @return Answer|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->answersRepository->create($data);
    }

    /**
     * @param int $id
     * @return Answer|Answer[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->answersRepository->findOrFail($id);
    }
}
