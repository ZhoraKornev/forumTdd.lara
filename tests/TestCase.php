<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    private $oldExceptionHandler;

    protected function setUp() :void
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    /**
     * @return TestCase
     */
    protected function signIn($user = null){
        $user = $user ?: create('App\User');
        $this->actingAs($user);
        return $this;
    }


    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }

}
