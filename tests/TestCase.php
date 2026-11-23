<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * Refuse to run against anything but a dedicated test database, so that
     * RefreshDatabase can never wipe the development (or any other) database.
     */
    public function createApplication()
    {
        $app = parent::createApplication();

        $connection = $app['config']->get('database.default');
        $database = $app['config']->get("database.connections.{$connection}.database");

        if ($database !== ':memory:' && !str_ends_with((string) $database, '_test')) {
            throw new RuntimeException(
                "Refusing to run tests against database '{$database}'. "
                . "Tests must use a database whose name ends in '_test' (see DB_DATABASE in phpunit.xml)."
            );
        }

        return $app;
    }
}
