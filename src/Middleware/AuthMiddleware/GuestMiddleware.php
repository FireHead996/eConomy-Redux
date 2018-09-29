<?php

namespace App\Middleware\AuthMiddleware;

use App\Middleware\Middleware;

class GuestMiddleware extends Middleware
{
    /**
     * Guest middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     */
    public function __invoke($request, $response, $next)
    {
        if ($this->container->auth->check()) {
            return $response->withRedirect($this->container->router->pathFor('home'));
        }
        
        $response = $next($request, $response);
        return $response;
    }
}
