<?php

//
// Controllers
//

// Index controller
$container['IndexController'] = function ($c) {
    return new \App\Controllers\IndexController($c);
};

// Authentication controller
$container['AuthController'] = function ($c) {
    return new \App\Controllers\Auth\AuthController($c);
};

// Account controller
$container['AccountController'] = function ($c) {
    return new \App\Controllers\Auth\AccountController($c);
};

// Ranking controller
$container['RankingController'] = function ($c) {
    return new \App\Controllers\RankingController($c);
};

// Mail controller
$container['MailController'] = function ($c) {
    return new \App\Controllers\Mail\MailController($c);
};