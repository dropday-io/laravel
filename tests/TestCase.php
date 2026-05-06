<?php

namespace Dropday\Dropday\Tests;

use Dropday\Dropday\DropdayServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [DropdayServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('dropday.api_key', 'test-key');
        $app['config']->set('dropday.account_id', 'test-account');
        $app['config']->set('dropday.base_url', 'https://dropday.io/api/v1');
    }
}
