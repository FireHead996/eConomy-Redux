<?php

namespace App\Middleware\FormsMiddleware;

use App\Middleware\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    /**
     * Validation errors middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     */
    public function __invoke($request, $response, $next)
    {
        if ($this->session->exists('errors'))
        {
            $this->view->getEnvironment()->addGlobal('errors', $this->session->errors);
            $this->session->delete('errors');
        }
        
        return $next($request, $response);
    }
}
