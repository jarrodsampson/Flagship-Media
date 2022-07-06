<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GreetingTest extends TestCase
{
    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/greeting');
        $response->assertStatus(200);
        $response->assertExactJson(['title' => 'Hello World']);
    }
}
