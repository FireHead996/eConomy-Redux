<?php

namespace App\Traits;

trait Containerable
{
    /**
     * Dependency Injection Container
     *
     * @var Container
     */
    protected $container;
    
    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    /**
     * Magic __get method for faster property pulling
     *
     * @param Object $property
     * @return Object $property
     */
    public function __get($property)
    {
        if ($this->container->{$property})
        {
            return $this->container->{$property};
        }
    }
}
