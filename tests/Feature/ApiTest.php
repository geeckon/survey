<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testSummary()
    {
        $this->seed();

        $response = $this->get('/api/questions/summary');
        $response->assertStatus(200)
            ->assertSeeText('Graph questions')
            ->assertSeeText('Open questions')
            ->assertSeeText('Question average')
            ->assertSeeText('Question answers count')
            ->assertSeeText('Answers per question option')
            ->assertSeeText('Word Cloud');
    }
}
