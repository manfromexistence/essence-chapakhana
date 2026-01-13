<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Disable exception handling for better error visibility in tests
        $this->withoutExceptionHandling();
    }

    /**
     * Create an authenticated user for testing.
     */
    protected function createAuthenticatedUser(array $attributes = []): \App\Models\User
    {
        $user = \App\Models\User::factory()->create($attributes);
        $this->actingAs($user);

        return $user;
    }

    /**
     * Create an admin user for testing.
     */
    protected function createAdminUser(array $attributes = []): \App\Models\User
    {
        $user = \App\Models\User::factory()->create(array_merge([
            'is_admin' => true,
        ], $attributes));

        $this->actingAs($user);

        return $user;
    }

    /**
     * Assert that cache has a specific key.
     */
    protected function assertCacheHas(string $key): void
    {
        $this->assertTrue(
            \Cache::has($key),
            "Failed asserting that cache has key [{$key}]."
        );
    }

    /**
     * Assert that cache does not have a specific key.
     */
    protected function assertCacheMissing(string $key): void
    {
        $this->assertFalse(
            \Cache::has($key),
            "Failed asserting that cache does not have key [{$key}]."
        );
    }
}
