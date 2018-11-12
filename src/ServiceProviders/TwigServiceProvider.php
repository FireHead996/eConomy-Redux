<?php

namespace App\ServiceProviders;

class TwigServiceProvider extends ServiceProvider
{
    private $twig;
    
    private function addExtensions() {
        $this->twig->addExtension(new \Slim\Views\TwigExtension(
            $this->container->router,
            $this->container->request->getUri()
        ));
    }
    
    private function addGlobals() {
        // Add auth
        $this->twig->getEnvironment()->addGlobal('auth', [
            'check' => $this->container->auth->check(),
            'user' => $this->container->auth->user(),
            'storage' => $this->container->auth->userStorage()
        ]);
        
        // Add flash messages
        $this->twig->getEnvironment()->addGlobal('flash', $this->container->flash);
    }
    
    public function __construct($c) {
        parent::__construct($c);
        
        $settings = $this->container->get('settings')['twig'];

        $this->twig = new \Slim\Views\Twig($settings['template_path'], [
            'cache' => $settings['cache']
        ]);
        
        $this->addExtensions();
        $this->addGlobals();
    }
    
    public function provide() {
        return $this->twig;
    }
}
