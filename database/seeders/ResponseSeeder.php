<?php

namespace Database\Seeders;

use App\Services\QuestionTypesService;
use App\Services\ResponsesService;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\App;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responses = 10000;
        if (App::environment('testing')) {
            $responses = 100;
        }

        /** @var ResponsesService $responsesService */
        $responsesService = app()->make(ResponsesService::class);

        /** @var QuestionTypesService $questionTypesService */
        $questionTypesService = app()->make(QuestionTypesService::class);
        $graphQuestionType = $questionTypesService->getBy([['name', 'Graph']])->first();

        foreach ($graphQuestionType->questions as $question) {
            $answers = $question->answers;

            for ($i = 0; $i < 10; $i++) {
                $data = [];
                for ($j = 0; $j < $responses; $j++) {
                    $data[] = [
                        'answer_id' => $answers->random()->id
                    ];
                }
                $responsesService->createMultiple($data);
            }
        }

        $openQuestionType = $questionTypesService->getBy([['name', 'Open']])->first();
        $question = $openQuestionType->questions()->first();
        $answer = $question->answers()->first();

        $data = [];
        for ($j = 0; $j < $responses; $j++) {
            $data[] = [
                'answer_id' => $answer->id,
                'text' => Inspiring::quote()
            ];
        }
        $responsesService->createMultiple($data);
    }
}
