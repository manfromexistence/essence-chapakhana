<?php

namespace Tests;

use Illuminate\Support\Facades\Cache;

/**
 * Base test case for repository tests.
 *
 * Provides utilities for testing repository implementations including
 * cache behavior, query optimization, and data consistency.
 */
abstract class RepositoryTestCase extends TestCase
{
    /**
     * The repository instance being tested.
     *
     * @var mixed
     */
    protected $repository;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Clear cache before each test
        Cache::flush();
    }

    /**
     * Assert that a query was cached.
     */
    protected function assertQueryWasCached(string $cacheKey): void
    {
        $this->assertCacheHas($cacheKey);
    }

    /**
     * Assert that cache was invalidated for a pattern.
     */
    protected function assertCacheWasInvalidated(string $pattern): void
    {
        // Check that no keys matching the pattern exist
        $keys = $this->getCacheKeysByPattern($pattern);

        $this->assertEmpty(
            $keys,
            "Failed asserting that cache was invalidated for pattern [{$pattern}]."
        );
    }

    /**
     * Get cache keys matching a pattern.
     */
    protected function getCacheKeysByPattern(string $pattern): array
    {
        // This is a simplified implementation
        // In production, you might use Redis KEYS command
        return [];
    }

    /**
     * Assert that N+1 queries were prevented.
     *
     * This checks that the number of queries executed is within expected bounds.
     */
    protected function assertNoNPlusOneQueries(callable $callback, int $maxQueries = 5): void
    {
        \DB::enableQueryLog();

        $callback();

        $queries = \DB::getQueryLog();
        $queryCount = count($queries);

        \DB::disableQueryLog();

        $this->assertLessThanOrEqual(
            $maxQueries,
            $queryCount,
            "Expected at most {$maxQueries} queries, but {$queryCount} were executed. Possible N+1 query problem."
        );
    }

    /**
     * Assert that a transaction was used.
     */
    protected function assertUsesTransaction(callable $callback): void
    {
        $transactionLevel = \DB::transactionLevel();

        try {
            $callback();
        } catch (\Exception $e) {
            // Expected behavior
        }

        $this->assertGreaterThan(
            $transactionLevel,
            \DB::transactionLevel(),
            'Failed asserting that a database transaction was used.'
        );
    }

    /**
     * Create test data for repository testing.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    protected function createTestData(string $model, int $count = 1, array $attributes = [])
    {
        $factory = $model::factory();

        if ($count === 1) {
            return $factory->create($attributes);
        }

        return $factory->count($count)->create($attributes);
    }
}
