<?php

namespace App\Middleware;

class Middleware
{
    /**
     * Dependency Injection Container
     *
     * @var Container
     */
    protected $container;

    /**
     * Middleware constructor
     *
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }
}
