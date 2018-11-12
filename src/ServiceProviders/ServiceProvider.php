<?php

namespace App\ServiceProviders;

abstract class ServiceProvider
{
    protected $container;
    
    public function __construct($c) {
        $this->container = $c;
    }
    
    abstract function provide();
}
