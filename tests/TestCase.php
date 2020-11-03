<?php

namespace AmirRezaM75\TokenizedLogin;

use AmirRezaM75\TokenizedLogin\TokenizedLoginServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [TokenizedLoginServiceProvider::class];
    }
}
