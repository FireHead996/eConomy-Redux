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
        if (isset($_SESSION['errors'])) {
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
        
        $response = $next($request, $response);
        return $response;
    }
}
