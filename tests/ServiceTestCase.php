<?php

namespace Tests;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Mockery;

/**
 * Base test case for service layer tests.
 *
 * Provides utilities for testing service classes including
 * mocking dependencies, event assertions, and transaction testing.
 */
abstract class ServiceTestCase extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Fake events and queues by default for service tests
        Event::fake();
        Queue::fake();
    }

    /**
     * Tear down the test environment.
     */
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    /**
     * Create a mock for a repository interface.
     */
    protected function mockRepository(string $interface): \Mockery\MockInterface
    {
        $mock = Mockery::mock($interface);
        $this->app->instance($interface, $mock);

        return $mock;
    }

    /**
     * Assert that an event was dispatched.
     */
    protected function assertEventDispatched(string $event, ?callable $callback = null): void
    {
        Event::assertDispatched($event, $callback);
    }

    /**
     * Assert that a job was pushed to the queue.
     */
    protected function assertJobPushed(string $job, ?callable $callback = null): void
    {
        Queue::assertPushed($job, $callback);
    }

    /**
     * Assert that a service method throws a specific exception.
     */
    protected function assertThrowsException(
        string $exceptionClass,
        callable $callback,
        ?string $expectedMessage = null
    ): void {
        try {
            $callback();

            $this->fail("Expected exception {$exceptionClass} was not thrown.");
        } catch (\Exception $e) {
            $this->assertInstanceOf(
                $exceptionClass,
                $e,
                "Expected exception {$exceptionClass}, but got ".get_class($e)
            );

            if ($expectedMessage !== null) {
                $this->assertEquals(
                    $expectedMessage,
                    $e->getMessage(),
                    'Exception message does not match expected message.'
                );
            }
        }
    }

    /**
     * Assert that a database transaction was rolled back.
     */
    protected function assertTransactionRolledBack(callable $callback, string $table, array $data): void
    {
        $initialCount = \DB::table($table)->count();

        try {
            $callback();
        } catch (\Exception $e) {
            // Expected behavior
        }

        $finalCount = \DB::table($table)->count();

        $this->assertEquals(
            $initialCount,
            $finalCount,
            'Failed asserting that transaction was rolled back. Data was persisted.'
        );
    }

    /**
     * Assert that cache was invalidated after an operation.
     */
    protected function assertCacheInvalidatedAfter(callable $callback, string $cacheKey): void
    {
        // Set cache before operation
        \Cache::put($cacheKey, 'test-value', 60);

        $callback();

        $this->assertCacheMissing($cacheKey);
    }

    /**
     * Create a DTO (Data Transfer Object) for testing.
     *
     * @return mixed
     */
    protected function createDTO(string $dtoClass, array $data)
    {
        return new $dtoClass(...array_values($data));
    }
}
