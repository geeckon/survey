<?php

namespace App\Services;

use App\Models\Question;
use App\Repositories\QuestionsRepository;
use App\Repositories\QuestionTypesRepository;
use Illuminate\Support\Str;

class QuestionsService
{
    /** @var QuestionsRepository */
    private $questionsRepository;
    /** @var QuestionTypesRepository */
    private $questionTypesRepository;

    /**
     * QuestionsService constructor.
     * @param QuestionsRepository $questionsRepository
     * @param QuestionTypesRepository $questionTypesRepository
     */
    public function __construct(
        QuestionsRepository $questionsRepository,
        QuestionTypesRepository $questionTypesRepository
    )
    {
        $this->questionsRepository = $questionsRepository;
        $this->questionTypesRepository = $questionTypesRepository;
    }

    /**
     * @return Question[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->questionsRepository->getAll();
    }

    /**
     * @param array $data
     * @return Question|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->questionsRepository->create($data);
    }

    /**
     * @param int $id
     * @return Question|Question[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOrFail(int $id)
    {
        return $this->questionsRepository->findOrFail($id);
    }

    /**
     * @param array $filter
     * @return Question[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBy(array $filter)
    {
        return $this->questionsRepository->getBy($filter);
    }

    /**
     * @return array
     */
    public function getGraphSummary()
    {
        $graphQuestionResults = [];
        $graphQuestionType = $this->questionTypesRepository->getBy([['name', 'Graph']])->first();

        foreach ($graphQuestionType->questions as $question) {
            $weighedResponses = 0;
            $totalResponseCount = 0;
            $responsesPerAnswer = [];

            foreach ($question->answers as $answer) {
                $responseCount = $answer->responses()->count();
                $responsesPerAnswer[$answer->text] = $responseCount;
                $totalResponseCount += $responseCount;
                $weighedResponses += $answer->value * $responseCount;
            }

            $questionAverage = $totalResponseCount === 0 ? 'N/A' : $weighedResponses / $totalResponseCount;

            $questionResult = [
                'Question average' => $questionAverage,
                'Question answers count' => $totalResponseCount,
                'Answers per question option' => $responsesPerAnswer,
            ];

            $graphQuestionResults[$question->text] = $questionResult;
        }

        return $graphQuestionResults;
    }

    /**
     * @return array
     */
    public function getOpenSummary()
    {
        $openQuestionResults = [];
        $openQuestionType = $this->questionTypesRepository->getBy([['name', 'Open']])->first();

        foreach ($openQuestionType->questions as $question) {
            $totalResponseCount = 0;
            $wordCloud = [];

            foreach ($question->answers as $answer) {
                foreach ($answer->responses as $response) {
                    $totalResponseCount++;
                    $words = Str::of($response->text)->remove(['.', '?', '!', ',', ';', ':', '-'])->upper()->explode(' ');
                    foreach ($words as $word) {
                        $word = trim($word);
                        if ($word) {
                            if (!array_key_exists($word, $wordCloud)) {
                                $wordCloud[$word] = 1;
                            } else {
                                $wordCloud[$word]++;
                            }
                        }
                    }
                }
            }

            $questionResult = [
                'Question answers count' => $totalResponseCount,
                'Word Cloud' => $wordCloud
            ];

            $openQuestionResults[$question->text] = $questionResult;
        }

        return $openQuestionResults;


    }

    /**
     * @return array
     */
    public function getSummary()
    {
        return [
            'Graph questions' => $this->getGraphSummary(),
            'Open questions' => $this->getOpenSummary(),
        ];
    }
}
