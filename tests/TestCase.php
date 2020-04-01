<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mcamara\LaravelLocalization\LaravelLocalization;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public static function setUpBeforeClass(): void
    {
        putenv(LaravelLocalization::ENV_ROUTE_KEY . '=en');
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        putenv(LaravelLocalization::ENV_ROUTE_KEY);
        parent::tearDownAfterClass();
    }
}
