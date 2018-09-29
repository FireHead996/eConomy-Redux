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

// Password controller
$container['PasswordController'] = function ($c) {
    return new \App\Controllers\Auth\PasswordController($c);
};