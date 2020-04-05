<?php

namespace Tests;

use App\User;
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

    public function signIn(array $attr = []): User
    {
        $user = factory(User::class)->create($attr);

        $this->actingAs($user);

        return $user;
    }
}
