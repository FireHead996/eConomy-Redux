<?php

use Illuminate\Database\Capsule\Manager as Capsule;

//
// Main configuration
//

// DIC configuration
$container = $app->getContainer();

// Twig renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['twig'];

    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache']
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->router,
        $c->request->getUri()
    ));

    // Add globaly available authentication methods
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->user()
    ]);

    // Add flash messages
    $view->getEnvironment()->addGlobal('flash', $c->flash);

    return $view;
};

// Database connection
$capsule = new Capsule;
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($c) {
    return $capsule;
};

require __DIR__ . '/controllers.php';

require __DIR__ . '/extensions.php';
