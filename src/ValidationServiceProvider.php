<?php

namespace Mpyw\LaravelFileErrors;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;

/**
 * Class ValidationServiceProvider
 */
class ValidationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend('validator', static function (Factory $factory) {
            $factory->resolver(static function (...$parameters) {
                return new Validator(...$parameters);
            });
            return $factory;
        });
    }
}
