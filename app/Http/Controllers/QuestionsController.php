<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Services\QuestionsService;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /** @var QuestionsService */
    private $questionsService;

    /**
     * QuestionsController constructor.
     * @param QuestionsService $questionsService
     */
    public function __construct(QuestionsService $questionsService)
    {
        $this->questionsService = $questionsService;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return QuestionResource::collection($this->questionsService->getAll());
    }

    /**
     * @param $id
     * @return QuestionResource
     */
    public function show($id)
    {
        return new QuestionResource($this->questionsService->findOrFail($id));
    }

    public function summary()
    {
        return $this->questionsService->getSummary();
    }
}
