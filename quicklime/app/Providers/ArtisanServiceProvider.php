<?php

namespace Quicklime\Providers;

use Quicklime\Console\OptimizeCommand;
use Illuminate\Foundation\Providers\ArtisanServiceProvider as FoundationASP;

class ArtisanServiceProvider extends FoundationASP
{
    protected function registerOptimizeCommand()
    {
        $this->app->singleton('command.optimize', function ($app) {
            return new OptimizeCommand($app['composer']);
        });
    }
}
