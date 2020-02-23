<?php

namespace Grocelivery\AdsCatalog\Tests\Traits;

use Laravel\Lumen\Application;

/**
 * Trait InitializingApp
 * @package Grocelivery\AdsCatalog\Tests\Traits
 */
trait InitializingApp
{
    /** @var Application $app */
    protected $app;

    /**
     * @Given initialized application
     */
    public function initializedApplication()
    {
        $this->app = require __DIR__.'/../../../bootstrap/app.testing.php';
    }
}
