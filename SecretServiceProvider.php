<?php

namespace Hubboot\Secret;

use Illuminate\Support\ServiceProvider;

class SecretServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}