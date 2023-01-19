<?php

namespace App\Services;

use App\Models\Response;
use App\Repositories\ResponsesRepository;

class ResponsesService
{
    /** @var ResponsesRepository */
    private $responsesRepository;

    /**
     * ResponsesService constructor.
     * @param ResponsesRepository $responsesRepository
     */
    public function __construct(ResponsesRepository $responsesRepository)
    {
        $this->responsesRepository = $responsesRepository;
    }

    /**
     * @return Response[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->responsesRepository->getAll();
    }

    /**
     * @param array $data
     * @return Response|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->responsesRepository->create($data);
    }

    /**
     * @param array $data
     * @return Response|\Illuminate\Database\Eloquent\Model
     */
    public function createMultiple(array $data)
    {
        return $this->responsesRepository->createMultiple($data);
    }

    /**
     * @param int $id
     * @return Response|Response[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->responsesRepository->findOrFail($id);
    }
}
