<?php

namespace Tests;

/**
 * Base test case for API endpoint tests.
 *
 * Provides utilities for testing API endpoints including
 * JSON assertions, authentication, and response validation.
 */
abstract class ApiTestCase extends TestCase
{
    /**
     * The base API URL.
     */
    protected string $apiBase = '/api';

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Set default headers for API requests
        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Make a GET request to an API endpoint.
     *
     * @param  string  $uri
     * @return \Illuminate\Testing\TestResponse
     */
    protected function getJson($uri, array $headers = [])
    {
        return parent::getJson($this->apiBase.$uri, $headers);
    }

    /**
     * Make a POST request to an API endpoint.
     *
     * @param  string  $uri
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postJson($uri, array $data = [], array $headers = [])
    {
        return parent::postJson($this->apiBase.$uri, $data, $headers);
    }

    /**
     * Make a PUT request to an API endpoint.
     *
     * @param  string  $uri
     * @return \Illuminate\Testing\TestResponse
     */
    protected function putJson($uri, array $data = [], array $headers = [])
    {
        return parent::putJson($this->apiBase.$uri, $data, $headers);
    }

    /**
     * Make a PATCH request to an API endpoint.
     *
     * @param  string  $uri
     * @return \Illuminate\Testing\TestResponse
     */
    protected function patchJson($uri, array $data = [], array $headers = [])
    {
        return parent::patchJson($this->apiBase.$uri, $data, $headers);
    }

    /**
     * Make a DELETE request to an API endpoint.
     *
     * @param  string  $uri
     * @return \Illuminate\Testing\TestResponse
     */
    protected function deleteJson($uri, array $data = [], array $headers = [])
    {
        return parent::deleteJson($this->apiBase.$uri, $data, $headers);
    }

    /**
     * Assert that the response has a successful status code.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     */
    protected function assertSuccessResponse($response): void
    {
        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data',
        ]);
    }

    /**
     * Assert that the response has an error status code.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     */
    protected function assertErrorResponse($response, int $statusCode = 422): void
    {
        $response->assertStatus($statusCode);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    /**
     * Assert that the response has validation errors.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     */
    protected function assertValidationErrors($response, array $fields): void
    {
        $response->assertStatus(422);
        $response->assertJsonValidationErrors($fields);
    }

    /**
     * Assert that the response is paginated.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     */
    protected function assertPaginatedResponse($response): void
    {
        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data',
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }

    /**
     * Assert that the response requires authentication.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     */
    protected function assertRequiresAuthentication($response): void
    {
        $response->assertStatus(401);
    }

    /**
     * Assert that the response is forbidden.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     */
    protected function assertForbidden($response): void
    {
        $response->assertStatus(403);
    }

    /**
     * Create an API token for authenticated requests.
     */
    protected function createApiToken(?\App\Models\User $user = null): string
    {
        $user = $user ?? \App\Models\User::factory()->create();

        // If using Sanctum or Passport, create token here
        // For now, just authenticate the user
        $this->actingAs($user);

        return 'test-token';
    }
}
