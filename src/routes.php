<?php

use App\Middleware\AuthMiddleware\GuestMiddleware;
use App\Middleware\AuthMiddleware\UserMiddleware;

// All access routes
$app->get('/', 'IndexController:index')->setName('home');
$app->get('/err', 'ErrorController:index')->setName('err');

// Guest access routes
$app->group('', function () {
    // Sign up
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    // Sign in
    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddleware($container));

// User access routes
$app->group('', function () {
    // Logout
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    // Password changing
    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');
})->add(new UserMiddleware($container));
