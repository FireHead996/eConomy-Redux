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
        if (isset($_SESSION['old'])) {
            $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        }
        
        $_SESSION['old'] = $request->getParams();
        
        return $next($request, $response);
    }
}
