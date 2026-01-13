<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Skip this test as it requires Vite assets to be built
        $this->markTestSkipped('Requires Vite assets to be built');

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
