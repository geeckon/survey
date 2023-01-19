<?php

namespace Tests\Feature;

use App\Services\QuestionsService;
use App\Services\QuestionTypesService;
use App\Services\ResponsesService;
use Database\Seeders\QuestionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JsonTest extends TestCase
{
    use RefreshDatabase;

    public function testJson()
    {
        $this->seed(QuestionSeeder::class);

        /** @var ResponsesService $responsesService */
        $responsesService = app()->make(ResponsesService::class);

        /** @var QuestionsService $questionsService */
        $questionsService = app()->make(QuestionsService::class);
        $question = $questionsService->getBy([['text', 'How likely are you to recommend Windows 10 to your friends and colleagues?']])->first();

        $data = [
            [
                'answer_id' => $question->answers()->where('value', 0)->first()->id,
            ],
            [
                'answer_id' => $question->answers()->where('value', 1)->first()->id,
            ],
            [
                'answer_id' => $question->answers()->where('value', 5)->first()->id,
            ],
        ];
        $responsesService->createMultiple($data);

        $question = $questionsService->getBy([['text', 'Please write an inspiring quote!']])->first();
        $data = [
            [
                'answer_id' => $question->answers->first()->id,
                'text' => 'This is a truly inspiring quote!',
            ],
            [
                'answer_id' => $question->answers->first()->id,
                'text' => 'I am not great at writing inspiring quotes!',
            ],
            [
                'answer_id' => $question->answers->first()->id,
                'text' => 'To quote or not to quote, that is the question!',
            ],
        ];
        $responsesService->createMultiple($data);

        $response = $this->get('/api/questions/summary');
        $response->assertStatus(200)
            ->assertJson([
                'Graph questions' => [
                    'How likely are you to recommend Windows 10 to your friends and colleagues?' => [
                        'Question average' => 2,
                        'Question answers count' => 3,
                        'Answers per question option' => [
                            '0' => 1,
                            '1' => 1,
                            '2' => 0,
                            '3' => 0,
                            '4' => 0,
                            '5' => 1,
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'Open questions' => [
                    'Please write an inspiring quote!' => [
                        'Question answers count' => 3,
                        'Word Cloud' => [
                            'THIS' => 1,
                            'IS' => 2,
                            'A' => 1,
                            'TRULY' => 1,
                            'INSPIRING' => 2,
                            'QUOTE' => 3,
                            'I' => 1,
                            'AM' => 1,
                            'NOT' => 2,
                            'GREAT' => 1,
                            'AT' => 1,
                            'WRITING' => 1,
                            'QUOTES' => 1,
                            'TO' => 2,
                            'OR' => 1,
                            'THAT' => 1,
                            'THE' => 1,
                            'QUESTION' => 1
                        ]
                    ]
                ]
            ]);
    }
}
