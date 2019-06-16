<?php

namespace App\Middleware\PseudocronMiddleware\Jobs;

interface Job
{
    public static function execute();
}
