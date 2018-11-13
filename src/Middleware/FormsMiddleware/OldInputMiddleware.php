<?php

namespace App\Middleware\FormsMiddleware;

use App\Middleware\Middleware;

class OldInputMiddleware extends Middleware
{
    /**
     * Old input middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     */
    public function __invoke($request, $response, $next)
    {
        if ($this->session->exists('old'))
        {
            $this->view->getEnvironment()->addGlobal('old', $this->session->old);
        }
        
        $this->session->set('old', $request->getParams());
        
        return $next($request, $response);
        
        
    }
}
