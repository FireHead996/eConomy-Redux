<?php

namespace App\Middleware\PseudocronMiddleware;

use App\Middleware\PseudocronMiddleware\Jobs\ExchangeJob;
use App\Middleware\PseudocronMiddleware\Jobs\ClearExchangeEventJob;

class PseudocronMiddleware
{
    private $jobs = [
        ExchangeJob::class,
        ClearExchangeEventJob::class,
    ];

    /**
     * Pseudo CRONjobs middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     * @throws \ReflectionException
     */
    public function __invoke($request, $response, $next)
    {
        foreach ($this->jobs as $job)
        {
            (new \ReflectionClass($job))->getMethod('execute')->invoke(null);
        }
        
        return $next($request, $response);
    }
}
