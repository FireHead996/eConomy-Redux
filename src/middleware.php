<?php
//
// Application middleware
//

// Validation errors middleware
$app->add(new \App\Middleware\FormsMiddleware\ValidationErrorsMiddleware($container));

// Old input middleware
$app->add(new \App\Middleware\FormsMiddleware\OldInputMiddleware($container));

// CSRF view middleware
$app->add(new \App\Middleware\FormsMiddleware\CsrfViewMiddleware($container));

// Session middleware
$app->add(new \Slim\Middleware\Session([
    'autorefresh' => true,
    'lifetime' => '20 minutes'
]));

// CSRF middleware
$app->add($container->csrf);
