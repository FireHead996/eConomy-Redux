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
    // Ranking
    $this->get('/ranking', 'RankingController:index')->setName('ranking');
    
    // Exchange
    $this->get('/exchange/prices', 'ExchangeController:prices')->setName('exchange.prices');
    
    $this->get('/exchange', 'ExchangeController:getExchange')->setName('exchange');
    $this->post('/exchange', 'ExchangeController:postExchange');
    
    // Mail
    $this->get('/mail/received', 'MailController:getReceivedMessages')->setName('mail.received');
    
    $this->get('/mail/sent', 'MailController:getSentMessages')->setName('mail.sent');
    
    $this->get('/mail/new', 'MailController:getNew')->setName('mail.new');
    $this->post('/mail/new', 'MailController:postNew');
    
    $this->get('/mail/new/{nickname}', 'MailController:getNewWithNickname')->setName('mail.new.withnickname');
    
    $this->get('/mail/received/delete/{id}', 'MailController:getDeleteReceived')->setName('mail.received.delete');
    $this->get('/mail/sent/delete/{id}', 'MailController:getDeleteSent')->setName('mail.sent.delete');
    
    // Password changing
    $this->get('/auth/password/change', 'AccountController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'AccountController:postChangePassword');
    
    // Logout
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
})->add(new UserMiddleware($container));
