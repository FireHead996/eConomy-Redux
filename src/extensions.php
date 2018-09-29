<?php

//
// Extensions
//

// 404 error page handler
$container['notFoundHandler'] = function ($c) {
    return new \App\Extensions\NotFound($c);
};

// Form validator
$container['validator'] = function ($c) {
    return new \App\Validation\Validator;
};

// CSRF protection
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard;
    return $guard->setFailureCallable(new \App\Middleware\FormsMiddleware\CsrfErrorMiddleware($c));
};

// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages();
};

// Authentication extension
$container['auth'] = function ($c) {
    return new \App\Extensions\Auth($c);
};

// Session helper
$container['session'] = function ($c) {
    return new \SlimSession\Helper;
};
