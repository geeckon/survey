<?php

namespace Database\Seeders;

use App\Services\AnswersService;
use App\Services\QuestionsService;
use App\Services\QuestionTypesService;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionTypes = [
            [
                'name' => 'Graph',
            ],
            [
                'name' => 'Open'
            ]
        ];

        /** @var QuestionTypesService $questionTypesService */
        $questionTypesService = app()->make(QuestionTypesService::class);
        foreach ($questionTypes as $questionType) {
            $questionTypesService->create($questionType);
        }

        $graphQuestionType = $questionTypesService->getBy([['name', '=', 'Graph']])->first();
        $openQuestionType = $questionTypesService->getBy([['name', '=', 'Open']])->first();

        $questions = [
            [
                'text' => 'How likely are you to recommend Windows 10 to your friends and colleagues?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How much do you like Star Wars?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How satisfied are you with your ISP?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How would you rate your juggling skills?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How likely are you to go to sleep before 10PM on a Friday night?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How many cups of coffee do you drink each day?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'What would be an appropriate number of children to have?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How likely do you think you are to reach the age of 100 years?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'How much did you enjoy this survey?',
                'question_type_id' => $graphQuestionType->id
            ],
            [
                'text' => 'Please write an inspiring quote!',
                'question_type_id' => $openQuestionType->id
            ],
        ];

        /** @var QuestionsService $questionsService */
        $questionsService = app()->make(QuestionsService::class);
        foreach ($questions as $question) {
            $questionsService->create($question);
        }

        /** @var AnswersService $answersService */
        $answersService = app()->make(AnswersService::class);
        foreach ($graphQuestionType->questions as $question) {
            for ($j = 0; $j < 6; $j++) {
                $answersService->create([
                    'text' => (string) $j,
                    'value' => $j,
                    'question_id' => $question->id
                ]);
            }
        }

        foreach ($openQuestionType->questions as $question) {
            $answersService->create([
                'text' => 'Open response',
                'question_id' => $question->id
            ]);
        }
    }
}
