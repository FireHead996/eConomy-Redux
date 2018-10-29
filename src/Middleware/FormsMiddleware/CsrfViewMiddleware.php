<?php

namespace App\Middleware\FormsMiddleware;

use App\Middleware\Middleware;

class CsrfViewMiddleware extends Middleware
{
    /**
     * CSRF view middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     */
    public function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden"
                    name="' . $this->container->csrf->getTokenNameKey() . '"
                    value="' . $this->container->csrf->getTokenName() . '">
                <input type="hidden"
                    name="' . $this->container->csrf->getTokenValueKey() . '"
                    value="' . $this->container->csrf->getTokenValue() . '">
            ',
        ]);
        
        return $next($request, $response);
    }
}
