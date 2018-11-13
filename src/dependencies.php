<?php

//
// Dependencies
//

// DIC configuration
$container = $app->getContainer();

// Twig renderer
$container['view'] = function ($c) {
    $twig = new \App\ServiceProviders\TwigServiceProvider($c);
    return $twig->provide();
};

// Database connection
$capsule = new \App\ServiceProviders\DatabaseServiceProvider($container);
$container['db'] = function ($c) {
    return $capsule->provide();
};
