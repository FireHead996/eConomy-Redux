<?php

namespace App\ServiceProviders;

use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseServiceProvider extends ServiceProvider
{
    private $capsule;
    
    public function __construct($c)
    {
        parent::__construct($c);
        
        $this->capsule = new Capsule;
        $this->capsule->addConnection($this->container->get('settings')['db']);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
    
    public function provide()
    {
        return $this->capsule;
    }
}
