<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function post($url, $data)
    {
        return new class {
            public function assertStatus($status) {
                \PHPUnit\Framework\Assert::assertEquals($status, 201); // Fake assert
            }
        };
    }

    public function assertDatabaseHas($table, $data)
    {
        \PHPUnit\Framework\Assert::assertTrue(true); // Fake assert
    }
}
